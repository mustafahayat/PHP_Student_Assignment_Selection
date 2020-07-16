  <!-- ========== COMMON JS FILES ========== -->
  <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script src="js/bootbox.all.min.js"></script>
        <script src="js/myjavascrip.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php //} ?>


<!-- Modal For the Change Password -->
  <!-- Modal -->
  <div class="modal fade" id="password" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Change Student Password</h4>
        </div>
        <div class="modal-body">
          <form  method="post">

            <div class="form-group">
                <label for="old" class=" control-label">Old Password</label>
                <div class="">
                    <input type="password" name="old" class="form-control" id="old" placeholder="Your Old Password" required>
                </div>
                <div id="result"></div>
            </div>

            <div class="form-group">
                <label for="new" class=" control-label">New Password</label>
                <div class="">
                    <input type="password" name="new" class="form-control" id="new" placeholder="Type NewPassword" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm" class=" control-label">Confirm Password</label>
                <div class="">
                    <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Retype New Password" required>
                </div>
                <div id="error"></div>
            </div>
           
            <div class="form-group mt-3">
                <!-- <input type="submit" value="Change Password" class="btn btn-success" id="submit"> -->
                <button type="submit" name="submit" id="submit" class="btn btn-success btn-labeled ">Change Password<span class="btn-label btn-label-right"><i class="fa fa-refresh"></i></span></button>
            </div>
            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php
  if(isset($_POST['old'])){
    
    $new = md5($_POST['new']);
    
    $rollno = $_SESSION['slogin'];
    $sql11 = "UPDATE students SET PASSWORD = :pass WHERE student_rollno = :roll";
    $statment = $dbh->prepare($sql11);
    $statment->bindParam(':pass', $new, PDO::PARAM_STR);
    $statment->bindParam(':roll', $rollno, PDO::PARAM_STR);
    if($statment->execute()){
        echo '<script> bootbox.alert({
            size : "large",
            title : "Success",
            message : "Your Password is Successfully Changed!!"
        });</script>';
    }else{
      echo '<script> bootbox.alert({
        size : "large",
        title : "Field",
        message : "Somthing Went Wrong Please Try Again!!"
    });</script>';
 
    }
     
  }
  ?>
