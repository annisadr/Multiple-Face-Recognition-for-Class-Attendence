<script type="text/javascript">
    function detail(id,kelas) {
     // alert(id+" "+kelas);

      $('#myModal').modal('show');
      $.ajax({
          url:'doAjaxDetail.php',
          type:'POST',
          data:{idjadwal:id,idkelas:kelas},
          success:function(result){
            console.log(result);
            var obj = JSON.parse(result);
            var html = "";
            var selected = "selected";
            $.each(obj,function(i,val){
               var option = "";
               html += '<tr align="center">';
               html += ' <td>'+val.no+'</td>';
               html += ' <td>'+val.nim+'</td>';
               if (val.status == 'Alfa') {
                  option = '<option value="A" '+selected+'>Alfa</option>';
               } else if(val.status == 'Hadir')  {
                  option = '<option value="H" '+selected+'>Hadir</option>';
               } else if(val.status == 'Sakit') {
                  option = '<option value="S" '+selected+'>Sakit</option>';
               } else {
                  option = '<option value="I" '+selected+'>Izin</option>';
               }
               html += '<td>';
               html +=    '<select name="statushadir" class="custom-select col-sm-5" style="font-size: 12px;">';
               html +=   option;
               html += '</td>';
               html += '</tr>';
               $('#htmlTd').html(html);

            });

          },
          error:function(err) {
            console.log(err)
          }

      });   
    }

  </script>

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
      <?php
        $idkelas = $_GET['idkelas'];
        $sql4 = "SELECT * FROM akademik.ak_kelas WHERE ak_kelas.idkelas='$idkelas'";
        $hasil4 = pg_query($sql4);
        $data4 = pg_fetch_array($hasil4);
      ?>
      <div class="row">
        <div class="col-sm-6">
          <h4>Presensi Kelas</h4>
        </div>
        <div class="col-sm-6" align="right" style="font-size: 12px;">
          <i class="fas fa-table"></i> 
          <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
          <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
          <a href="index.php?page=presensi&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Presensi</a>
          <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
          <a href="index.php?page=lpresensi&&nimnik=<?php echo $data['nimnik'];?>&&idkelas=<?php echo $data4['idkelas'];?>" style="color: black;">Presensi Kelas</a>
          <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
          <strong>Face Recognition</strong>
        </div>
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
                  <input type="hidden" name="res" id="val">
                  <button type= "button" class="btn btn-success" id="process">Process</button>
                </div>
                <!-- <div class="col-md-6" style="margin-top: 20px; margin-bottom: 20px;">
                  <input type="file" class="custom-file-input" id="customFile" name="filename">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div> -->
            </div>
        </form>
    </div>


    <div class="row">
        <!-- Modal -->
          <div class="modal fade" id="modal-hasil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <center><h4><strong>Analisis Penjualan <i>E-ticketing</i> Bus DAMRI Segmen Antar Kota Cabang Bandar Lampung</strong></h4></center>
                  <h4 class="form-wording" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                  <span id="result" style="display: block; font-weight: bold; text-align: center;"></span>
                  <h5><b><span class="solusi" ></span></b></h5>
                </div>
              </div>
            </div>
          </div>
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
      reloadserve();
      $('#process').click(function(e){
                e.preventDefault();
                var data = $('#val').val();
                var idjadwal = "<?php echo $_GET['idjadwal'];?>";
                $.ajax({
                  url : 'http://127.0.0.1:5000/facerec',
                  type : 'POST',
                  data : {res:data,jadwal:idjadwal},
                  success : function(response) {
                    //console.log(lupa disini manggil apa)
                    console.log(response.data.nim , "NIM")
                    var id = response.data.nim;
                    reloadserve();
                    checknim(id,idjadwal);
                   

                  },
                  error : function(err) {
                    alert('eror');
                  }
                });
            });

      function checknim(nim,jadwal,idkelas) {
          $.ajax({
            url : 'doCheckNim.php',
            type: 'POST',
            data : {nim:nim,idjadwal:jadwal},
            success : function(response) {
              console.log(response, "CEK DATA")
              var val = JSON.parse(response);
              if (val.result == 1) {
                alert('NIM Sudah Melakukan Presensi');
              } else if(val.result == 2) {
                alert('NIM Tidak Terdaftar');
              } else {
                alert('NIM Berhasil diinput');
              }

            },
            error : function(err) {
              alert('error');
            }  
          });
      }


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