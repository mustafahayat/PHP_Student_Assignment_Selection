<?php

    require_once("includes/config.php");


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
            header("Location:manage-student.php?filetype=incorrect");
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
        $msg = "Student info added successfully";
    } else {
        $error =  "Something went wrong. Please try again";
        print_r(($query->errorInfo()));
        exit();
    }
}
?>
<!-- ========================= Start Of Top Header =================================== -->

<?php
// session_start();
error_reporting(0);
include('includes/config.php');
// if(strlen($_SESSION['slogin'])=="")
//     {   
//     header("Location: index.php"); 
//     }
//    // else{
//         ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Result Management System | Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/fontawesome-free-5.10.2-web/css/all.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
              <?php include('includes/topbar.php');?>
            <div class="content-wrapper">
                <div class="content-container">



<!-- =============================== End Of The Header ================================= -->
<!-- ========== LEFT SIDEBAR ========== -->
<?php //include('includes/leftbar.php'); ?>
<!-- /.left-sidebar -->

<div class="main-page">

    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h2 class="title">Student Admission</h2>

            </div>

            <!-- /.col-md-6 text-right -->
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                    <li class="active">Student Admission</li>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>Fill the Student info</h5>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if ($msg) { ?>
                            <div class="alert alert-success left-icon-alert" role="alert">
                                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                            </div><?php } else if ($error) { ?>
                            <div class="alert alert-danger left-icon-alert" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                            </div>
                        <?php } ?>

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
                                        <?php $sql = "SELECT class_name from classes";
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
                                    <select name="section" class="form-control" id="default" required="required">
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
                            
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="password" minlength="5">
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
                                    <input type="date" name="register_date"  class="form-control">  
                                    
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
                </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
    </div>
</div>
<!-- /.content-container -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- /.main-wrapper -->



<?php require_once("includes/bottomfooter.php"); ?>