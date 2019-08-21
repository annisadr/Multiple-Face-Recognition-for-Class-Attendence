import cv2
import numpy as numpy
import os
import datetime
import csv
import pandas as pd
import sys
import time
import psycopg2

#koneksi postgres
connection = psycopg2.connect(user="postgres",
                              password="pwpostgres",
                              host="localhost",
                              port="5432",
                              database="akademik")
cursor = connection.cursor()

recognizer = cv2.face.LBPHFaceRecognizer_create()
recognizer.read('../trainer/trainer.yml')
faceCascade = cv2.CascadeClassifier('../assets/cascades/data/haarcascade_frontalface_default.xml');
df = pd.read_csv("../StudentDetails/StudentDetails.csv")
img = cv2.imread('../dosen/data-uji/190816093643.jpeg')

font = cv2.FONT_HERSHEY_SIMPLEX
# cam = cv2.VideoCapture(1)
# col_names = ['Id','Date','Time']
# attendance = pd.DataFrame(columns=col_names)
# while  True:
	# ret, im = img.read()
# ret, img = cam.read()
gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
faces = faceCascade.detectMultiScale(gray, 1.3,5)
nim = "";

for(x,y,w,h) in faces:
	cv2.rectangle(img, (x-20,y-20), (x+w+20,y+h+20), (0,255,0), 2)
	Id, conf = recognizer.predict(gray[y:y+h,x:x+w])
	if(Id > 50) :
		ts = time.time()      
		date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
		timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
		
		tt = str(Id)
		# cursor.execute("SELECT * FROM akademik.facerec WHERE nim = %s AND idjadwal = %s;",["2015230014","262337"])
		# if cursor.rowcount<1:
		sql = "INSERT INTO akademik.facerec (nim, tgl, waktu, idjadwal) VALUES (%s,%s,%s,%s)"
		record = (Id,date,timeStamp,"22222")
		cursor.execute(sql,record)
		connection.commit()
		count = cursor.rowcount
		
		# cursor.execute("SELECT * FROM akademik.facerec WHERE nim = %s AND idjadwal = %s;",[Id,"262337"])
		# if cursor.rowcount < 1:
		# 	sql = "INSERT INTO akademik.facerec (nim, tgl, waktu, idjadwal) VALUES (%s,%s,%s,%s)"
		# 	record = (Id,date,timeStamp,"262337")
		# 	cursor.execute(sql,record)
		# 	connection.commit()
		# 	count = cursor.rowcount

        # cursor.execute("SELECT * FROM akademik.ak_absensimhs WHERE nim = %s AND idjadwal = %s;",[Id,"262337"])
        # if cursor.rowcount < 1:
        #     #insert absensi
        #     status = "H"
        #     sqlabsen = "INSERT INTO akademik.ak_absensimhs (nim, idjadwal, statushadir) VALUES (%s,%s,%s)"
        #     recordabsen = (Id,"262337",status)
        #     cursor.execute(sqlabsen,recordabsen)
        #     connection.commit()
        #     count = cursor.rowcount
	else:
		Id = 'Unknown'
		tt = str(Id)
	if(conf > 75):
		noOfFile = len(os.listdir("ImagesUnknown"))+1
		cv2.imwrite("ImagesUnknown/Image"+str(noOfFile) + ".jpg", img[y:y+h,x:x+w])
	cursor.execute("SELECT namamhs FROM akademik.ak_mahasiswa WHERE nim = %s;",[Id])
	record = cursor.fetchall()
	for row in record:
		nama = str(row[0])
	tt = str(Id)
	nim += tt
	cv2.putText(img, str(nama+tt), (x,y+h), font, 1, (255,255,255), 1)
cv2.imshow('img',img)
cv2.waitKey(10000)
ts = time.time()
date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
Hour,Minute,Second=timeStamp.split(":")
# fileName="../Attendance/Attendance_"+date+"_"+Hour+"-"+Minute+"-"+Second+".csv"
# attendance.to_csv(fileName,index=False)

cv2.destroyAllWindows()