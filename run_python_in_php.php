<?php
echo shell_exec("python /opt/lampp/htdocs/presensi-kelas/webcamambil.py 2>&1"); //("python -V 2>&1") =>hanya bisa python, gak bisa python3
?>
<!DOCTYPE html>
<html>
<head>
	<title>coba</title>
</head>
<body>
	<div class="booth">
	  <center><video id="video" width="400" height="300"></video></center>
	  <a href="#" id="capture" class="booth-capture-button">Take photo</a>
	  <canvas id="canvas" width="400" height="300"></canvas>
	</div>
</body>
</html>