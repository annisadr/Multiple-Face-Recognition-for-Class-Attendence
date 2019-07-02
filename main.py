import cv2
import numpy as numpy
import os
import datetime
import csv
import pandas as pd
import sys
import time
from flask import Flask, jsonify, abort, request, make_response, url_for, render_template
from flask_cors import CORS, cross_origin

# def assure_path_exists(path):
#     dir = os.path.dirname(path)
#     if not os.path.exists(dir):
#         os.makedirs(dir)


app = Flask(__name__, static_url_path = "/static")
cors = CORS(app)

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

@app.route('/facerec', methods = ['GET'])
def facerec():
    recognizer = cv2.face.LBPHFaceRecognizer_create()
    recognizer.read('trainer/trainer.yml')
    faceCascade = cv2.CascadeClassifier('assets/acascades/data/haarcascade_frontalface_default.xml');
    df = pd.read_csv("StudentDetails/StudentDetails.csv")
    img = cv2.imread('foto/2019-06-28-163815.jpg')

    font = cv2.FONT_HERSHEY_SIMPLEX
    # cam = cv2.VideoCapture(1)
    col_names = ['Id','Date','Time']
    attendance = pd.DataFrame(columns=col_names)
    while  True:
        # ret, im = img.read()
        gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
        faces = faceCascade.detectMultiScale(gray, 1.3,5)
        for(x,y,w,h) in faces:
            cv2.rectangle(img, (x-20,y-20), (x+w+20,y+h+20), (0,255,0), 2)
            Id, conf = recognizer.predict(gray[y:y+h,x:x+w])
            if(Id < 50) :
                ts = time.time()      
                date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
                timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
                
                tt = str(Id)    
                attendance.loc[len(attendance)] = [tt,date,timeStamp]
                # fileName = "Attendance/Attendance_"+date+"_"+Hour+"-"+Minute+"-"+Second+".csv"
                # df.to_csv(fileName, index = False)
            # else:
                # Id = 'Unknown'
                # tt = str(Id)
            if(conf > 75):
                noOfFile = len(os.listdir("ImagesUnknown"))+1
                cv2.imwrite("ImagesUnknown/Image"+str(noOfFile) + ".jpg", img[y:y+h,x:x+w])
            tt = str(Id)
            cv2.putText(img, str(tt), (x,y+h), font, 1, (255,255,255), 1)
        cv2.imshow('img',img)
        if cv2.waitKey(10) & 0xFF == ord('q'):
            break
    ts = time.time()
    date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
    timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
    Hour,Minute,Second=timeStamp.split(":")
    fileName="Attendance/Attendance_"+date+"_"+Hour+"-"+Minute+"-"+Second+".csv"
    attendance.to_csv(fileName,index=False)
    cv2.destroyAllWindows()
def getpict():
    vid_cam = cv2.VideoCapture(1)
    face_detector = cv2.CascadeClassifier('assets/cascades/data/haarcascade_frontalface_default.xml')
    face_id = input("Masukkan NIM: ")
    count = 0
    while(vid_cam.isOpened()):
        ret, Image_frame = vid_cam.read()
        gray = cv2.cvtColor(Image_frame, cv2.COLOR_BGR2GRAY)
        faces = face_detector.detectMultiScale(gray, 1.3, 5)
        for (x,y,w,h) in faces:
            cv2.rectangle(Image_frame, (x,y), (x+w,y+h), (255,0,0), 2)
            count += 1
            cv2.imwrite("dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
            cv2.imshow('frame', Image_frame)
        if cv2.waitKey(100) & 0xFF == ord('q'):
            break
        elif count>99:
            break
    vid_cam.release()
    cv2.destroyAllWindows()

    res = "Images Saved for ID : " + face_id
    row = [face_id]
    with open('StudentDetails/StudentDetails.csv','a+') as csvFile:
        writer = csv.writer(csvFile)
        writer.writerow(row)
    csvFile.close()
    
if __name__ == '__main__':
    app.run(debug = True)