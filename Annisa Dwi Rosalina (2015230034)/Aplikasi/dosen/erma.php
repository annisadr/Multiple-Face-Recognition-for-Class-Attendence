<?php

    //error_reporting(0);

    include '../config/koneksi.php';

    $id_count = $_GET['id_count'];

    $edit    = "SELECT * FROM tbl_count WHERE id_count = '$id_count'";
    $hasil   = mysqli_query($konek, $edit)or die(mysql_error());
    $data    = mysqli_fetch_array($hasil);

?>

<!-- Breadcomb area Start-->
    <div class="breadcomb-area">    
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-form"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Analisis / Predict Data</h2>
                                        <p><i>Analysis System V 1.0.0 Cabang Bandar Lampung</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcomb area End-->
    <!-- Form Element area Start-->

     <div class="form-example-area">
        <div class="container">
            <div class="row">
                <form id="form-predict" class="form-horizontal" method="POST">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
                        <div class="form-example-int form-horizental mg-t-15">
                            <div class="form-group">
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id_count" value="<?php echo $data['id_count']; ?>">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Jam Berangkat</label>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                           <input type="text" class="form-control" name="id_jam" placeholder="Jam Berangkat" value="<?php echo $data['id_jam']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Trayek</label>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="Trayek" value="<?php echo $data['id_trayek']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Jenis Layanan</label>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                             <input type="text" class="form-control" name="id_layanan" placeholder="Layanan" value="<?php echo $data['id_layanan']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Jumlah Seat</label>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" name="jml_seat" placeholder="Jumlah Seat" value="<?php echo $data['jml_seat']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-example-int form-horizental">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Jumlah Penumpang</label>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-7 col-xs-12">
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" name="jml_penumpang" placeholder="Jumlah Penumpang" value="<?php echo $data['jml_penumpang']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="breadcomb-wp">
                                   
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                <div class="breadcomb-report">
                                    <button type="submit" data-toggle="tooltip" data-placement="left" title="Lakukan Analisis" class="btn"><i class="fa fa-rocket fa-fw"></i> Predict</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                <div class="modal-footer">
                    <?php

                        //error_reporting(0);

                        include '../config/koneksi.php';

                        $id_count = $_GET['id_count'];

                        $edit    = "SELECT * FROM tbl_count WHERE id_count = '$id_count'";
                        $hasil   = mysqli_query($konek, $edit)or die(mysql_error());
                        $data    = mysqli_fetch_array($hasil);

                        echo '<a href="index.php?content=solusi&&id_count='.$data['id_count'].'"><button type="button" class="btn btn-danger" >Close</button></a>';

                    ?>
                  
                </div>
              </div>
            </div>
          </div>
    </div>
    <!-- End Modals-->

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> 
   <script type="text/javascript">
                    
          $("#form-predict").submit(function(e) {
            <?php
                include '../config/koneksi.php';

                $id_count       = $_GET['id_count'];

                $update         = "UPDATE tbl_count SET status='1' WHERE id_count='$id_count'";
                $updatecount    = mysqli_query($konek, $update)or die(mysqli_error($konek));
            ?>
            var url = "http://127.0.0.1:8000/api/v1/result"; 
            //var xhr = new XMLHttpRequest({mozSystem: true});
            var data = $("#form-predict").serialize();
            console.log("data", data)
            $.ajax({
                      type: "POST",
                      url: url,
                      data: data, // serializes the form's elements.
                      success: function(data)
                      {
                          console.log("predict "+ data.response.predict)
                          var id = "<?php echo $_GET['id_count'];?>";
                          console.log("id "+id)
                          
                         $('#modal-hasil').modal('show');
                            updatePredict(id, data.response.predict)
                          if (data.response.predict == 1) {
                            
                            $('#result').html("Laris");


                            var id_jam = data.response.id_jam;
                            var id_layanan = data.response.id_layanan;
                            var jml_seat = data.response.jml_seat;
                            var jml_penumpang = data.response.jml_penumpang;

                          } else {
                            $('#result').html("Tidak Laris");

                            var id_jam = data.response.id_jam;
                            var id_layanan = data.response.id_layanan;
                            var jml_seat = data.response.jml_seat;
                            var jml_penumpang = data.response.jml_penumpang;

                          }  
                      },
                      error: function (request, status, error) {
                          alert(request.responseText);
                      }
                     });

          
            e.preventDefault(); // avoid to execute the actual submit of the form.
          });

          function updatePredict(id,result) {

            $.ajax({
                url:'../config/update_laris.php',
                type: "POST",
                data : {id:id, result:result},
                success:function(result){
                    console.log('oke');
                },
                error:function(err){
                    alert('error');
                }

            });
          }
          </script>
