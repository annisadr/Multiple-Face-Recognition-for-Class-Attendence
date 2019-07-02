import cv2
vid_cam = cv2.VideoCapture(1)
face_detector = cv2.CascadeClassifier('../cascades/data/haarcascade_frontalface_default.xml')
face_id = 1
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
	elif count>100:
		break
vid_cam.release()
cv2.destroyAllWindows()