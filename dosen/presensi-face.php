<!DOCTYPE html>
<html>
<head>
    <title>Capture image</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:10px; border:1px solid; }
    </style>
</head>
<body>
    <?php
        include "../config/koneksi.php";
        $idjadwal = $_GET['idjadwal'];

        $query = pg_query($conn,"SELECT * FROM akademik.ak_perkuliahan WHERE idjadwal = '$idjadwal'");
        $hasill = pg_fetch_array($query);
    ?>
    <div class="container">
      <div class="module-head">
          <h5><large>Presensi Kelas</large></h5><br>
      </div>
    </div>
    <div class="container" style="padding-bottom: 10px; padding-top: 10px; background: white;">
        <!-- <input type="hidden" name="nim" class="form-control" readonly value="<?php echo $hasill['idjadwal'] ?>"> -->
        
        <form method="POST" action="index.php?page=savepict&&nimnik=<?php echo $data['nimnik'];?>&&idjadwal=<?php echo $hasil['idjadwal'];?>" id="facerec">
          <input type="hidden" name="idjadwal" class="form-control" readonly value="<?php echo $hasill['idjadwal'] ?>">

            <div class="row">
                <div class="col-md-6">
                    <div id="my_camera"></div>
                    <br/>
                    <input type=button class="btn btn-info" value="Take Snapshot" onClick="take_snapshot()">
                    <input type="hidden" name="image" class="image-tag">
                </div>
                <div class="col-md-6">
                    <div id="results">Your captured image will appear here...</div>
                </div>
                <div class="col-md-12 text-center">
                    <br/>
                    
                        <input type="hidden" name="res" id="val">
                        <button type= "button" class="btn btn-success" id="process">Process</button>
                        
                   
                </div>
            </div>
        </form>
    </div>
    <!-- Configure a few settings and attach camera -->
    <script type="text/javascript">
        Webcam.set({
            width: 490,
            height: 370,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach( '#my_camera' );

            function take_snapshot() {
                Webcam.snap( function(data_uri) {
                    $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                    processingfile(data_uri);
                });
            }

            function processingfile(result) {
                //store temp file foto 
                $.ajax({
                   type:'POST',
                   url:'storeimagetmp.php',
                   data: {result:result},
                   success:function(resp) {
                        var a = JSON.parse(resp);
                        $('#val').val(a.data);                      
                   }
                });
            }

            // $('#facerec').submit(function(e){
            //   e.preventDefault();
            //   var data = $('#facerec').serialize();
            //   $.ajax({
            //     url : 'http://127.0.0.1:5000/facerec',
            //     type : 'POST',
            //     data : data,
            //     success : function(response) {
            //       console.log(response)
            //     },
            //     error : function(err) {
            //       alert('eror');
            //     }
            //   });

            // });
      $('#process').click(function(e){
                e.preventDefault();
                var data = $('#val').val();
                var idjadwal = "<?php echo $_GET['idjadwal'];?>";
                $.ajax({
                  url : 'http://127.0.0.1:5000/facerec',
                  type : 'POST',
                  data : {res:data,jadwal:idjadwal},
                  success : function(response) {
                    console.log(response)
                    reloadserve();
                  },
                  error : function(err) {
                    alert('eror');
                  }
                });
            });


      function reloadserve() {
        $.ajax({
          url : 'http://127.0.0.1:5000/restart',
          type: 'GET',
          //data : "",
          success : function(response) {
            console.log(response)
          },
          error : function(err) {
            alert('error');
          }  
        });
      }

    </script>

    <!-- <script type="text/javascript">
      $(document).ready(function(){
        $("#btnFacerec").click(function(){
          alert("tes")
          $.ajax({
            type: "POST",
            url: "http://127.0.0.1:5000/",
            datatype: "JSON",
            success : function(response){
              console.log("rec")
           });
        });
      });
    </script> -->
</body>
</html>