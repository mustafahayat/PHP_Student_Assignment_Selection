<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/fontawesome-free-5.10.2-web/css/all.css" media="screen">
    <!-- <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen"> -->
    <!-- <link rel="stylesheet" href="css/prism/prism.css" media="screen"> -->
     <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
    <link rel="stylesheet" href="css/main.css" media="screen">

    <!-- <script src="js/modernizr/modernizr.min.js"></script> -->
    

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- <script src="js/pace/pace.min.js"></script> -->
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <!-- <script src="js/iscroll/iscroll.js"></script> -->

    <!-- ========== PAGE JS FILES ========== -->

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script src="js/bootbox.all.min.js"></script>
</head>

<?php


error_reporting(0);
include('includes/config.php');

if (isset($_POST['rollno'])) {

    $uname1 = $_POST['rollno'];
    $password1 = md5($_POST['password']);
    // echo $uname1; echo $password1;
    // exit();
    $sql1 = "SELECT student_rollno, password FROM students WHERE student_rollno=:uname and password=:password";
    $query1 = $dbh->prepare($sql1);
    $query1->bindParam(':uname', $uname1, PDO::PARAM_STR);
    $query1->bindParam(':password', $password1, PDO::PARAM_STR);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
    if ($query1->rowCount() > 0) {

        $_SESSION['slogin'] = $uname1;
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {?>

        <script>
           document.location = "index.php?error=field";
        </script>
        
   <?php }  
}

?>




<body class="">
    <div class="main-wrapper">

        <div class="">
            <div class="row">
                <h1 align="center">Student Assignment Management System</h1>
                <div class="col-lg-12">
                    <section class="section">
                        <div class="row mt-10">
                            <div class="col-md-10 col-md-offset-1 pt-50">

                                <div class="row mt-100 ">
                                    <div class="col-md-12">
                                        <div class="panel shadow-xl">
                                            <div class="panel-heading">
                                                <div class="panel-title text-center">
                                                    <h4>Students Login</h4>
                                                </div>
                                            </div>
                                            <div class="panel-body p-20">

                                                <div class="section-title">
                                                    <p class="sub-title">Student Assignment Management System</p>
                                                </div>

                                                <form class="form-horizontal" method="post">
                                                    <div class="form-group">
                                                     
                                                        <label for="rollid" class="col-sm-2 control-label">Your Roll No</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="rollid" placeholder="Enter Your Roll No" autocomplete="off" name="rollno" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="rollid" class="col-sm-2 control-label">Your Password</label>
                                                        <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="rollid" placeholder="Enter Your Password" autocomplete="off" name="password" required>
 <!-- Invalid Username Or Paasword -->
    <?php
         if(isset($_GET['error'])){
             echo "<div class='text-danger'><strong>Field:</strong> Invalid Roll_No Or  Password! Please Create New Account Or Try Again!!</div>";
         
             echo '<script> bootbox.alert({
                size : "large",
                title : "Field",
                className: "text-danger",
                message : "Invalid Roll_No Or  Password! Please Create New Account Or Try Again!!"
            });</script>';
         
            } 


    ?>
                                                    </div>
                                                        
                                                    </div>


                                                    <div class="form-group mt-20">
                                                        <div class="col-sm-offset-2 col-sm-10">

                                                            <button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                            
                                                        </div>
                                                        <a href="#student" data-toggle="modal"  class="text-primary text-sm">Create New Account</a>
                                                    </div>
                                                </form>




                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                        <p class="text-muted text-center"><small>Copyright © SRMS</small></p>
                                    </div>
                                    <!-- /.col-md-11 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->
                    </section>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /. -->

    </div>
    <!-- /.main-wrapper -->

    <script>
        $(function() {

        });
    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

<!-- Modal Sign-Up The Students -->
  <!-- Modal -->
  <div class="modal fade" id="student" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Register New Student</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Full Name</label>
    <div class="col-sm-10">
        <input type="text" name="fullname" class="form-control" id="fullanme" required="required" autocomplete="off">
    </div>
</div>

<div class="form-group has-success">
    <label for="default" class="col-sm-2 control-label">Rool ID</label>
    <div class="col-sm-10">
        <input type="text" name="rollid" class="form-control" id="rollid" maxlength="5" required="required" autocomplete="off">
        <span class="help-block">Eg- <strong>1SF</strong>(<strong>1</strong> -> Roll, <strong>S</strong>-> Software Endgineering, <strong>F</strong>-> First Year) etc</span>
    </div>
</div>

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input type="email" name="email" class="form-control" id="email" required="required" autocomplete="off">
    </div>
</div>







<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Gender</label>
    <div class="col-sm-10">
        <input type="radio" name="gender" value="Male" required="required" checked=""> Male 
        <input type="radio" name="gender" value="Female" required="required">Female 
        <input type="radio" name="gender" value="Other" required="required">Other
    </div>
</div>
<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
        <select name="department" class="form-control" id="default" required="required">
            <option value="">Select Department</option>
            <?php $sql = "SELECT department from classes";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {   ?>
                    <option>
                        <?php   echo $result->department; ?>
                    </option>
            <?php }
            } ?>
        </select>
    </div>
</div>


<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Class</label>
    <div class="col-sm-10">
        <select name="class" class="form-control" id="default" required="required">
            <option value="">Select Class</option>
            <?php $sql = "SELECT DISTINCT class_name from classes";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {   ?>
                    <option value="<?php echo $result->class_name; ?>">
                        <?php  if($result->class_name == 1) echo "First";
                                else if($result->class_name == 2) echo "Second";
                                else if($result->class_name == 3) echo "Third";
                                else echo "Fourth"; ?>
                    </option>
            <?php }
            } ?>
        </select>
    </div>
</div>


<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Section</label>
    <div class="col-sm-10">
        <select name="section" class="form-control" id="default" >
            <option value="">Select Section</option>
            <?php $sql = "SELECT section_name from classes";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {   ?>
                    <option>
                    <?php echo htmlentities($result->section_name); ?> 
                    </option>
            <?php }
            } ?>
        </select>
    </div>
        </div>

<div class="form-group has-success">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        <input type="password" name="password" class="form-control" id="password" minlength="5">
        <span class="help-block"><strong>Passwor Must Be Five Character Long!!</strong></span>
    </div>
</div>

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        <input type="radio" name="status" value="1" required="required" checked=""> Active 
        <input type="radio" name="status" value="0" required="required">Passed 
        
    </div>
</div>

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Register Date</label>
    <div class="col-sm-10">
        <input type="date" name="register_date" value="<?php echo date("Y-m-d"); ?>"  class="form-control">  
        
    </div>
</div>



<div class="form-group">
    <label for="photo" class="col-sm-2 control-label">Photo</label>
    <div class="col-sm-10">
        <input type="file" name="photo" accept="image/*" class="custom-file-input form-control" id="photo">
        
    </div>
</div>



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
    </div>
</div>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>





</body>

</html>


<?php

     


if (isset($_POST['submit'])) {
    $studentname = $_POST['fullname'];
    $roolid = $_POST['rollid'];
     $roolid = strtoupper($roolid);
   
    $email = $_POST['email'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $classid = $_POST['class'];
    $section = $_POST['section'];
    $password = md5($_POST['password']);
    $status = $_POST['status'];
    $date = $_POST['register_date'];
     
    
    
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
                title : "Field",
                message : "File Type Incorrect! Choose (.jpg, .png, .gif) File!!"
            });</script>';
            exit(); // to skip the follow code 
        }
    }else{
        if($gender == "Male")
        $path = "../image/male.png";
        else
        $path = "../image/female.png";
    }

    
    
    // $sql = "INSERT INTO  tblstudents(StudentName,RollId,StudentEmail,Gender,ClassId,DOB,Status) 
    // VALUES(:studentname,:roolid,:studentemail,:gender,:classid,:dob,:status)";

    $sql = "INSERT INTO `students`(`student_rollno`, `fullname`, `department`, `class_name`, `section_name`, `photo`, 
    `status`, `register_date`, `email`, `gender`, `password`) VALUES 
    (:roll, :fullname, :department, :class, :section, :photo, :status, :date, :email, :gender, :password)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname', $studentname, PDO::PARAM_STR);
    $query->bindParam(':roll', $roolid, PDO::PARAM_STR);
    $query->bindParam(':department', $department, PDO::PARAM_STR);
    $query->bindParam(':class', $classid, PDO::PARAM_INT);
    $query->bindParam(':section', $section, PDO::PARAM_STR);
    $query->bindParam(':photo', $path, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    // print $sql;
    // exit();

    ;
    $lastInsertId = $dbh->lastInsertId($roolid);
    if ($query->execute()) {
        echo '<script> bootbox.alert({
            size : "large",
            title : "Success",
            className : "text-success",
            message : "Student Successfully Registered!!"
        });</script>';
    } else {
        echo '<script> bootbox.alert({
            size : "large",
            title : "Field",
            className: "text-danger",
            message : "Something Went Wrong! Please Try Again!!"
        });</script>';
         
    }
}
?>