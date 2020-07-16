  <!-- ========== COMMON JS FILES ========== -->
  <script src="../js/jquery/jquery-2.2.4.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/pace/pace.min.js"></script>
        <script src="../js/lobipanel/lobipanel.min.js"></script>
        <script src="../js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="../js/prism/prism.js"></script>
        <script src="../js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="../js/main.js"></script>
        <script src="../js/bootbox.all.min.js"></script>
        <script src="../js/myjavascrip.js"></script>
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
          <h4 class="modal-title text-center">Change Admin Password</h4>
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
    $confirm = $_POST['confirm'];
    $username = $_SESSION['alogin'];
    $sql11 = "UPDATE USERS SET PASSWORD = :pass WHERE username = :username";
    $statment = $dbh->prepare($sql11);
    $statment->bindParam(':pass', $new, PDO::PARAM_STR);
    $statment->bindParam(':username', $username, PDO::PARAM_STR);
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
    print_r($statment->errorInfo());
    exit();
 
    }
     
  }
  ?>

  
<!-- Modal For the Add New User -->
  <!-- Modal -->
  <div class="modal fade" id="user" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Add New User</h4>
        </div>
        <div class="modal-body">
          <form  method="post" enctype="multipart/form-data">

          <div class="form-group">
                <label for="name" class=" control-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Type Your Fullname" required>
          </div>


            <div class="form-group">
                <label for="old" class=" control-label">User Name</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Type Username" required>
            </div>

            <div class="form-group">
                <label for="new" class=" control-label">New Password</label>
                <div class="">
                    <input type="password" name="password" class="form-control" id="password1" placeholder="Type Password" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm" class=" control-label">Confirm Password</label>
                <div class="">
                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Retype Password" required>
                </div>
                <div id="not"></div>
            </div>

            <div class="form-group">
                <label for="confirm" class=" control-label">Chose Your Photo</label>
                <div class="">
                    <input type="file" accept="image/*" name="photo" class="custom-file-input form-control" id="photo">
                </div>
                 
            </div>
           
            <div class="form-group mt-3">
                <!-- <input type="submit" value="Change Password" class="btn btn-success" id="submit"> -->
                <button type="submit" name="submit" id="submit1" class="btn btn-success btn-labeled ">Add User<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
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
  if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $name = $_POST['name'];
    if($_FILES['photo']['name'] != ""){

      $type = $_FILES["photo"]["type"];
      if($type == "image/jpeg" || $type == "image/png" || $type == "image/gif") {
          // we add the time() function beacuse may be the name is same.
          // they will replace one another.
      $path = "../image/" . time() . $_FILES['photo']['name'];
      move_uploaded_file($_FILES['photo']['tmp_name'], $path);
     
      }else{
        echo '<script> bootbox.alert({
          size : "large",
          className: "text-danger",
          title : "Field",
          
          message : "Please Choose The (.jpg, .png, .gif) File, And Try Again!!"
      });</script>';
       
          // header("Location:manage-student.php?filetype=incorrect");
          exit(); // to skip the follow code 
      }
  }else{
      $path = "../image/male.png";
      
  }

  $sql11 = "INSERT INTO `users`( `username`, `password`, `photo`, `fullname`) VALUES (:username, :password, :photo , :name) ";
  $statment = $dbh->prepare($sql11);
  $statment->bindParam(':username', $username, PDO::PARAM_STR);
  $statment->bindParam(':password', $password, PDO::PARAM_STR);
  $statment->bindParam(':photo', $path, PDO::PARAM_STR);
  $statment->bindParam(':name', $name, PDO::PARAM_STR);
  
  if($statment->execute()){
      echo '<script> bootbox.alert({
          size : "large",
          title : "Success",
          className: "text-Success",
          message : "User Successfull Added!!"
      });
       
      </script>';
  }else{
    echo '<script> bootbox.alert({
      size : "large",
      title : "Field",
      className: "text-danger",
      message : "The Username is Already Available! Try to use different Username!!"
  });</script>';

  }

  }

?>



 
    </body>
</html>
 


<!-- The Following Code is Used For the styling the Code of the Change Password. -->
<script>
$("#submit").click(function(){
            // alert(" Submit is called");
        var newPass =  $("#new").val();

        var confirmPass =  $("#confirm").val();
       console.log(newPass + confirmPass);
        if(newPass != confirmPass){
         
             $("#confirm").css({"border": "1px solid red"});
             $("#new").css({"border": "1px solid red"});
             $("#confirm").val("");
             $("#new").val("");
             $("#error").html("<span class='text-danger'><strong>Invalid! </strong> New Password And Confirm Password Are Not Equal!</span>");
             $("#new").focus();
             event.preventDefault();
        } 
     });
 
 
     // check the old password 
     $("#old").blur(function(){
        
         var old = $("#old").val();
         
        
         
         $.post("check_password.php", "password="+old , function(data){
            console.log(data);
             if(data == "1"){
                 $("#result").html("<span class='text-success'><strong>Valid! </strong> Your Old Password Is Ok!</span>");
             }else{
                 $("#result").html("<span class='text-danger'><strong>Invalid! </strong> Your Old Password Is Not Ok!</span>");
                 $("#old").val("");
                 $("#old").focus();
             }
         })
     });



     // Code for the new user password and confirm password
     $("#submit1").click(function(){
            // alert(" Submit is called");
        var newPass =  $("#password1").val();

        var confirmPass =  $("#confirmPassword").val();
       console.log(password1 + confirmPassword);
        if(newPass != confirmPass){
         
             $("#confirmPassword").css({"border": "1px solid red"});
             $("#password1").css({"border": "1px solid red"});
             $("#confirmPassword").val("");
             $("#password1").val("");
             $("#not").html("<span class='text-danger'><strong>Invalid! </strong> New Password And Confirm Password Are Not Equal!</span>");
             $("#password1").focus();
             event.preventDefault();
        } 
     });
 
</script>

