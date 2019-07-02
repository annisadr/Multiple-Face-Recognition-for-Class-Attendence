import cv2
import numpy as numpy
import os
import datetime
import csv
import pandas as pd
import sys
import time
# import psycopg2

#koneksi postgres
# try:
#    connection = psycopg2.connect(user="postgres",
#                                   password="pwpostgres",
#                                   host="localhost",
#                                   port="5432",
#                                   database="akademik")
#    cursor = connection.cursor()
#    print ("Record inserted successfully into mobile table")

recognizer = cv2.face.LBPHFaceRecognizer_create()
recognizer.read('trainer/trainer.yml')
faceCascade = cv2.CascadeClassifier('../cascades/data/haarcascade_frontalface_default.xml');
df = pd.read_csv("StudentDetails/StudentDetails.csv")
img = cv2.imread('../foto/2019-06-28-121759.jpg')

font = cv2.FONT_HERSHEY_SIMPLEX
# cam = cv2.VideoCapture(1)
col_names = ['Id','Date','Time']
attendance = pd.DataFrame(columns = col_names)
while  True:
	# ret, img = cam.read()
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
			# aa = df.loc[df['face_id'] == Id]['Id'].values
			
			
			
			# fileName = "Attendance/Attendance_"+date+"_"+Hour+"-"+Minute+"-"+Second+".csv"
			# df.to_csv(fileName, index = False)
			cv2.putText(img, str(tt), (x, h + y), font, 1, (255, 255, 0,), 1)
		else:
			Id = 'Unknown'
			tt = str(Id)
			cv2.rectangle(img, (x, y), (x + w, y + h), (0, 260, 0), 7)
			cv2.putText(img, str(tt), (x + h, y), font, 1, (255, 255, 0,), 4)

	# if(conf > 75):
	# 	noOfFile = len(os.listdir("ImagesUnknown"))+1
	# 	cv2.imwrite("ImagesUnknown/Image"+str(noOfFile) + ".jpg", im[y:y+h,x:x+w])
	# tt = str(Id)
	# cv2.putText(im, str(tt), (x,y+h), font, 1, (255,255,255), 2)
	cv2.imshow('img',img)
	if cv2.waitKey(10) & 0xFF == ord('q'):
		break
attendance.loc[len(attendance)] = [Id,date,timeStamp]
ts = time.time()
date = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
timeStamp = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')
Hour,Minute,Second=timeStamp.split(":")
fileName="Attendance/Attendance_"+date+"_"+Hour+"-"+Minute+"-"+Second+".csv"
attendance.to_csv(fileName, index=False)

cv2.destroyAllWindows()