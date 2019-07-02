import cv2, os
import numpy as np
from PIL import Image
recognizer = cv2.face.LBPHFaceRecognizer_create()
detector = cv2.CascadeClassifier('../cascades/data/haarcascade_frontalface_default.xml');
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