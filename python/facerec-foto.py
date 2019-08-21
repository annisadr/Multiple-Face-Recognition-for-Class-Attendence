import cv2
import numpy as numpy
import os
import datetime
import csv
import pandas as pd
import sys
import time
import psycopg2
from matplotlib import pyplot as plt
import glob

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
# df = pd.read_csv("../StudentDetails/StudentDetails.csv") #StudentDetails/StudentDetails.csv
img = cv2.imread('../foto/190708085755.jpeg')
font = cv2.FONT_HERSHEY_SIMPLEX
col_names = ['Id','Date','Time']
attendance = pd.DataFrame(columns = col_names)
loop=0
Nloop=1
while (loop<Nloop):
	loop=loop+1
	
	gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
	faces = faceCascade.detectMultiScale(gray, 1.3,5)
	
	for(x,y,w,h) in faces:
		cv2.rectangle(img, (x-20,y-20), (x+w+20,y+h+20), (0,255,0), 2)
		Id, conf = recognizer.predict(gray[y:y+h,x:x+w])
		tt = str(Id)
		if(Id > 50) :
			ts = time.time()      
			date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
			timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
			Hour,Minute,Second=timeStamp.split(":")
			cursor.execute("SELECT idkelas FROM akademik.ak_krs WHERE nim = %s;", [Id])
			for row in cursor.fetchall():
				idkelas = row[0]
				# A = idkelas.strip()
				sql = "INSERT INTO akademik.facerec (nim, tgl, waktu, idkelas) VALUES (%s,%s,%s,%s)"
				record = (Id,date,timeStamp,idkelas)
				cursor.execute(sql,record)
				connection.commit()
				count = cursor.rowcount
				print (count, "Successfully")

			print ("anda tidak terdaftar")
					# attendance.loc[len(attendance)] = [Id,date,timeStamp]
			cv2.putText(img, str(tt), (x, h + y), font, 1, (255, 255, 0,), 1)
		else:
			Id = 'Unknown'
			tt = str(Id)
			cv2.rectangle(img, (x, y), (x + w, y + h), (0, 260, 0), 7)
			cv2.putText(img, str(tt), (x + h, y), font, 1, (255, 255, 0,), 4)
		attendance=attendance.drop_duplicates(subset=['Id'],keep='first')
	cv2.imshow('img',img)
	if cv2.waitKey(10) & 0xFF == ord('q'):
		break
	if 0xFF == ord('c'):
		cursor.execute("SELECT * FROM akademik.facerec WHERE nim = %s AND idjadwal = %s;",[Id,'262337'])
        if cursor.rowcount < 1:
            sql = "INSERT INTO akademik.facerec (nim, tgl, waktu, idjadwal) VALUES (%s,%s,%s,%s)"
            record = (Id,date,timeStamp,'262337')
            cursor.execute(sql,record)
            connection.commit()
            count = cursor.rowcount	
ts = time.time()
date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
Hour,Minute,Second=timeStamp.split(":")
# fileName="Attendance/Attendance_"+date+"_"+Hour+"-"+Minute+"-"+Second+".csv"
# attendance.to_csv(fileName, index=False)



# data = pd.read_csv(Attendance_)

cv2.destroyAllWindows()