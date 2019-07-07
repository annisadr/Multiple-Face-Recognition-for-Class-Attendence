<?php

    $img = $_POST['image'];
    $folderPath = "upload/";

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.jpg';

    $file = $folderPath . $fileName;
    while(file_put_contents($file, $image_base64))
    {
    
?>

<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
<script type="text/javascript">
    $("#form-predict").submit(function(e) {
        var url = "http://127.0.0.1:8000/api/v1/facerec"; 
        //var xhr = new XMLHttpRequest({mozSystem: true});
        var data = $("#form-predict").serialize();
        console.log("data", data)
</script> -->

<?php

    print"
            <script>
                history.back(-1);             
            </script>";
    }
?>
<!-- <META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../dosen/index.php?page=facerec&&nimnik=<?php echo $data['nimnik'];?>&&idjadwal=<?php echo $hasill['idjadwal'];?>'> -->