<?php
include('koneksi.php');
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$img=$_FILES['image']['name'];
	$insert="insert into dtimage value ('NULL','$name','$img')";
	if(mysql_query($insert))
	{
		move_uploaded_file($_FILES['image']['tmp_name'],"../img/$img");
		echo"<script>alert('image has been uploaded to folder')</script>";
	}
	else{
		echo"<script>alert('image does not upload to folder')</script>";
	}
}

?>

<html>
<head>
 <title>Image Upload Into Folder Using PHP</title>
</head>
<body>
    <form action="index.php" enctype="multipart/form-data" method="post">
    	<label>Name</label>
    	<input type="text" name="name">
    	<br>
    	<label>Select Image To Upload</label>
    	<input type="file" name="image">

    	<input type="submit" name="submit" value="Upload The Picture">
    </form>
</body>
</html>