import cv2
import numpy as np
from PIL import Image
import os
import datetime
import csv
import pandas as pd
import sys
import time
from flask import Flask, jsonify, abort, request, make_response, url_for, render_template
from flask_cors import CORS, cross_origin
from multiprocessing import Process, Queue
import psycopg2
import subprocess



# def assure_path_exists(path):
#     dir = os.path.dirname(path)
#     if not os.path.exists(dir):
#         os.makedirs(dir)

#koneksi postgres
connection = psycopg2.connect(user="postgres",
                              password="pwpostgres",
                              host="localhost",
                              port="5432",
                              database="akademik")
cursor = connection.cursor()

some_queue = None

app = Flask(__name__)
cors = CORS(app)

to_reload = False
def reload():
    global to_reload
    to_reload = True
    return "reloaded"

@app.errorhandler(400)
def not_found(error):
    return make_response(jsonify( { 'error': 'Bad request' } ), 400)

@app.errorhandler(404)
def not_found(error):
    return make_response(jsonify( { 'error': 'Not found' } ), 404)


# main route
# render index.html
@app.route('/', methods = ['GET'])
def index():
    return render_template('index.html')

#face recognition
@app.route('/facerec', methods = ['POST'])
def facerec():
    getidjadwal = str(request.form['jadwal']);
    images_path = "dosen/"+str(request.form['res']);
    # foto = str(request.form['res']);
    # ces = "dosen/uploadtmp/190706104734.jpeg";
    recognizer = cv2.face.LBPHFaceRecognizer_create()
    recognizer.read('trainer/trainer.yml')
    faceCascade = cv2.CascadeClassifier('assets/cascades/data/haarcascade_frontalface_default.xml');

    img = cv2.imread(images_path) 
    font = cv2.FONT_HERSHEY_SIMPLEX
    
    gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
    faces =  faceCascade.detectMultiScale(gray, 1.3,5)
    for(x,y,w,h) in faces:
        cv2.rectangle(img, (x-20,y-20), (x+w+20,y+h+20), (0,255,0), 2)
        Id, conf = recognizer.predict(gray[y:y+h,x:x+w])
        if(Id > 50) : #ini ambigu
            ts = time.time()
            date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
            timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
            tt = str(Id)
            cursor.execute("SELECT * FROM akademik.facerec WHERE nim = %s AND idjadwal = %s;",[Id,getidjadwal])
            if cursor.rowcount < 1:
                sql = "INSERT INTO akademik.facerec (nim, tgl, waktu, idjadwal) VALUES (%s,%s,%s,%s)"
                record = (Id,date,timeStamp,getidjadwal)
                cursor.execute(sql,record)
                connection.commit()
                count = cursor.rowcount

                #insert absensi
                status = "H"
                sqlabsen = "INSERT INTO akademik.ak_absensimhs (nim, idjadwal, statushadir) VALUES (%s,%s,%s)"
                recordabsen = (Id,getidjadwal,status)
                cursor.execute(sqlabsen,recordabsen)
                connection.commit()
                count = cursor.rowcount
        else:
            Id = 'Unknown'
            tt = str(Id)
        tt = str(Id)
        cv2.putText(img, str(tt), (x,y+h), font, 1, (255,255,255), 1)
    cv2.imshow('img',img)
    cv2.waitKey(10000)

    cv2.destroyAllWindows()
    return "success running"
    
    
#take photo mahasiswa
@app.route('/getpict', methods = ['POST'])
def getpict():
    getnim = str(request.form['nim']);
    vid_cam = cv2.VideoCapture(1)
    face_detector = cv2.CascadeClassifier('assets/cascades/data/haarcascade_frontalface_default.xml')
    face_id = getnim 
    count = 0
    while(vid_cam.isOpened()):
        ret, Image_frame = vid_cam.read()
        gray = cv2.cvtColor(Image_frame, cv2.COLOR_BGR2GRAY)
        faces = face_detector.detectMultiScale(gray, 1.3, 5)
        for (x,y,w,h) in faces:
            cv2.rectangle(Image_frame, (x,y), (x+w,y+h), (255,0,0), 2)
            count += 1
            cv2.imwrite("dataset/User." + face_id + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
            cv2.imshow('frame', Image_frame)
        if cv2.waitKey(10) & 0xFF == ord('q'):
            break
        elif count>49:
            break
        # sql = "UPDATE akademik.user SET ketfoto=1 WHERE nimnik='%s'" %(face_id)
    vid_cam.release()
    cv2.destroyAllWindows()
    return "success"

    # with open('StudentDetails/StudentDetails.csv','a+') as csvFile:
    #     writer = csv.writer(csvFile)
    #     writer.writerow(row)
    # csvFile.close()

#training
@app.route('/training', methods = ['GET'])
def training():    
    recognizer = cv2.face.LBPHFaceRecognizer_create()
    detector = cv2.CascadeClassifier('assets/cascades/data/haarcascade_frontalface_default.xml');
    def getImagesAndLabels(path):
        imagesPaths = [os.path.join(path,f) for f in os.listdir(path)]
        faceSamples = []
        ids = []
        for imagesPath in imagesPaths:
            PIL_img = Image.open(imagesPath).convert('L')
            img_numpy = np.array(PIL_img,'uint8')
            id = int(os.path.split(imagesPath)[-1].split(".")[1])
            faces = detector.detectMultiScale(img_numpy)
            for (x,y,w,h) in faces:
                faceSamples.append(img_numpy[y:y+h,x:x+w])
                ids.append(id)
        return faceSamples,ids
    faces,ids =  getImagesAndLabels('dataset')
    recognizer.train(faces, np.array(ids))
    recognizer.save('trainer/trainer.yml')
    return "success"


@app.route('/restart', methods = ['GET'])
def restart():
    try:
        some_queue.put("something")
        print ("Restarted successfully")
        return "Quit"
    except: 
        
        return "Failed"

def start_flaskapp(queue):
    global some_queue
    some_queue = queue
    app.run()


if __name__ == '__main__':
        q = Queue()
        p = Process(target=start_flaskapp, args=[q,])
        p.start()
        while True:
            if q.empty(): 
                time.sleep(1)
            else:
                break
        p.terminate()
        args = [sys.executable] + [sys.argv[0]]
        subprocess.call(args)