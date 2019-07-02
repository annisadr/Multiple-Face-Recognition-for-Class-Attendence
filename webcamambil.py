# import cv2
# vid_cam = cv2.VideoCapture(0)
# face_detector = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
# face_id = 1
# count = 0
# while(vid_cam.isOpened()):
#     ret, image_frame = vid_cam.read()
#     gray = cv2.cvtColor(image_frame, cv2.COLOR_BGR2GRAY)
#     faces = face_detector.detectMultiScale(gray, 1.3, 5)
#     for (x,y,w,h) in faces:
#         cv2.rectangle(image_frame, (x,y), (x+w,y+h), (255,0,0), 2)
#         count += 1
#         cv2.imwrite("dataset/2015230." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])
#         cv2.imshow('frame', image_frame)
#     if cv2.waitKey(100) & 0xFF == ord('q'):
#         break
#     elif count>100:
#         break
# vid_cam.release()
# cv2.destroyAllWindows()

import cv2

face = cv2.CascadeClassifier('cascades/haarcascade_frontalface_default.xml')

cam = cv2.VideoCapture(0)
jumlah = 0
nim = input("Masukkan NIM: ")


while True:
    _, frame = cam.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    muka = face.detectMultiScale(gray, 1.3, 5)
    for (x,y,w,h) in muka:
       cv2.rectangle(frame, (x,y), (x+w,y+h), (255,0,0), 2)

       jumlah=jumlah+1

       cv2.imwrite("images/ "+nim +"." + str(jumlah) + ".jpg", gray[y:y + h, x:x + w])
       cv2.imshow('frame',img)

       if cv2.waitKey(1) & 0xff == ord('q'):
             break
        elif jumlah>60:
            break

cam.release()
cv2.destroyAllWindows()

