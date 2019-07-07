<!-- EDIT TERMINAL -->
<div class="modal fade" id="edit<?= $data1['nim'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="#" method="POST" class="form-horizontal">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Take Photo</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
             
            <input type="text" name="nim" class="form-control" readonly value="<?php echo $data1['nim'] ?>">

            
            <div id="container" align="center">
              <video autoplay="true" id="videoElement" width="450px" height="300px">
              
              </video>
            </div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="#"><button type="submit" class="btn btn-primary">Start</button></a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>