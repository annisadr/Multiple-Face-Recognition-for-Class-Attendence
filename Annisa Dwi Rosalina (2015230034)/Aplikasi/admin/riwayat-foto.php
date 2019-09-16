<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h4>Data Foto Presensi</h4>
    </div>
    <div class="col-sm-6" align="right" style="font-size: 12px;">
      <i class="fas fa-table"></i> 
      <a href="index.php?page=index&&nimnik=<?php echo $data['nimnik'];?>" style="color: black;">Home</a>
      <a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;</a>
      <strong>Foto Presensi</strong>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 20px;">
  <div class="container" style="background-color: white; padding-top: 20px;">
    <form class="form-inline" action="../config/proses-delfoto.php">
      <button type="submit" name="refresh" value="refresh" class="btn btn-primary" onclick="refresh()">Refresh</button>
    
    <div class="table-responsive">    
      <table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <?php
            $no=0;
            function daftar_file($dir)
            {
                if(is_dir($dir))
                {
                    if($handle = opendir($dir))
                    {
                //tampilkan semua file dalam folder kecuali
                        while(($file = readdir($handle)) !== false)
                        {
                    
                    echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>'."\n";
                        }
                        closedir($handle);
                    }
                }
            }
            //cara menggunakan
            daftar_file("../dosen/uploadtmp/");
            ?>
          </tr>
        </tbody> 
      </table>
    </div>
    </form>
  </div>
</div>