<?php require_once("includes/toheader.php"); 

require_once("includes/config.php"); ?>

<?php
$stid = $_GET['stid'];

$sql = "SELECT STUDENTS.*, CLASSES.CLASS_NAME FROM STUDENTS INNER JOIN CLASSES ON STUDENTS.class_name = CLASSES.class_name WHERE students.student_rollno = :roll AND STUDENTS.SECTION_NAME = CLASSES.SECTION_NAME";
$query = $dbh->prepare($sql);
$query->bindParam(':roll', $stid, PDO::PARAM_INT);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);


 
if (isset($_POST['submit'])) {
    $studentname = $_POST['fullname'];
    $roolid = $_POST['rollid'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $classid = $_POST['class'];
    $section = $_POST['section'];
     
    $status = $_POST['status'];
    $date = $_POST['register_date'];
     
    
    
    if($_FILES['photo']['name'] != ""){
        
        $type = $_FILES["photo"]["type"];
        if($type == "image/jpeg" || $type == "image/png" || $type == "image/gif") {
            // we add the time() function beacuse may be the name is same.
            // they will replace one another.
        $path = "image/" . time() . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $path); 
        if(!($row["photo"] == "image/male.png" || $row["photo"] == "image/female.png")) { 
            unlink($row["photo"]);
        }
        }else{
            header("Location:manage-student.php?filetype=incorrect");
            exit(); // to skip the follow code 
        }
    }else{
         
        $path = $row['photo'];
         
    }
    
    
    
    // $sql = "INSERT INTO  tblstudents(StudentName,RollId,StudentEmail,Gender,ClassId,DOB,Status) 
    // VALUES(:studentname,:roolid,:studentemail,:gender,:classid,:dob,:status)";

    $sql1 = "UPDATE students SET student_rollno = :rollid, fullname = :fullname, department =:department, class_name = :class,
    section_name = :section,photo =  :photo, status =  :status,register_date = :date, email = :email,gender =  :gender WHERE student_rollno = :roll";
    

    $query = $dbh->prepare($sql1);
    $query->bindParam(':roll', $stid, PDO::PARAM_STR);

    $query->bindParam(':fullname', $studentname, PDO::PARAM_STR);
    $query->bindParam(':rollid', $roolid, PDO::PARAM_STR);
    $query->bindParam(':department', $department, PDO::PARAM_STR);
    $query->bindParam(':class', $classid, PDO::PARAM_INT);
    $query->bindParam(':section', $section, PDO::PARAM_STR);
    $query->bindParam(':photo', $path, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    //  print "The Path is : ". $path;
    // print $sql;
    // exit();

    
    
    if ($query->execute()) {
        $msg = "Student info Updated successfully!";
        header("location: manage-students.php?msg=".$msg);
    } else {
        $error ="Something went wrong. Please try again!";
        print_r($query->errorInfo());
        exit();
    }
}
?>
 
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">

        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('includes/leftbar.php'); ?>
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

                                    <?php

                                    // $sql = "SELECT STUDENTS.*, CLASSES.CLASS_NAME FROM STUDENTS INNER JOIN CLASSES ON STUDENTS.CLASS_ID = CLASSES.CLASS_ID WHERE students.student_rollno = :roll AND STUDENTS.SECTION_NAME = CLASSES.SECTION_NAME";
                                    // $query = $dbh->prepare($sql);
                                    // $query->bindParam(':roll', $stid, PDO::PARAM_INT);
                                    // $query->execute();
                                    // $row = $query->fetch(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?php echo htmlentities($row['fullname'] );  ?>" name="fullname" class="form-control" id="fullanme" required="required" autocomplete="off">
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="default" " class="col-sm-2 control-label">Rool ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?php echo htmlentities($row['student_rollno'] );  ?>" name="rollid" class="form-control" id="rollid" maxlength="5" required="required" autocomplete="off">
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email"  value="<?php echo htmlentities($row['email'] );  ?>" name="email" class="form-control" id="email" required="required" autocomplete="off">
                                        </div>
                                    </div>
        
        
                                    
                                   
        
        
        
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <?php if($row['gender']== "Male"){  ?>
                                            <input type="radio" name="gender" value="Male" required="required" checked=""> Male 
                                            <input type="radio" name="gender" value="Female" required="required">Female 
                                            <input type="radio" name="gender" value="Other" required="required">Other
                                           <?php }else if($row['gender']=="Female"){ ?>
                                            
                                            <input type="radio" name="gender" value="Male" required="required"  > Male 
                                            <input type="radio" name="gender" value="Female" required="required" checked="">Female 
                                            <input type="radio" name="gender" value="Other" required="required">Other
                                           <?php }else{ ?>
                                            
                                            <input type="radio" name="gender" value="Male" required="required"  > Male 
                                            <input type="radio" name="gender" value="Female" required="required" >Female 
                                            <input type="radio" name="gender" value="Other" required="required" checked="">Other
                                           <?php } ?>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Department</label>
                                        <div class="col-sm-10">
                                            <select name="department" class="form-control" id="default" required="required">
                                                <option selected="selected" value="<?php echo htmlentities($row['department'] );  ?>"><?php echo htmlentities($row['department'] );  ?></option>
                                                <option value="Software Engineering">Software Engineering</option>
                                                <option value="Database">Database</option>
                                                <option value="Networking">Networking</option>
                                                
                                            </select>
                                        </div>
                                    </div>
        
        
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Class</label>
                                        <div class="col-sm-10">
                                            <select name="class" class="form-control" id="default" required="required">
                                            <option value="<?php echo htmlentities($row['class_name'] );  ?>"><?php echo htmlentities($row['CLASS_NAME'] );  ?> </option>
                                                <?php $sql = "SELECT class_name from classes";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {   ?>
                                                        <option value="<?php echo htmlentities($result->class_name); ?>">
                                                            <?php echo htmlentities($result->class_name); ?>
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
                                                <option value="<?php echo htmlentities($row['section_name'] );  ?>"><?php echo htmlentities($row['section_name'] );  ?> </option>
                                                <?php $sql = "SELECT section_name from classes";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {   ?>
                                                        <option value="<?php echo htmlentities($result->section_name); ?>">
                                                        <?php echo htmlentities($result->section_name); ?> </option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                            </div>
                                    
                                    
        
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">
                                            <?php if($row['status'] == 1){ ?>
                                            <input type="radio" name="status" value="1" required="required" checked=""> Active 
                                            <input type="radio" name="status" value="0" required="required">Passed 
                                            <?php }else{ ?>    
                                            <input type="radio" name="status" value="1" required="required" > Active                                    
                                            <input type="radio" name="status" value="0" required="required" checked="">Passed 
                                            <?php } ?>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Register Date</label>
                                <div class="col-sm-10">
                                    <input type="date" value="<?php echo $row['register_date']; ?>" name="register_date"  class="form-control">  
                                    
                                </div>
                            </div>
        
                                    
        
                                    <div class="form-group">
                                        <label for="photo" class="col-sm-2 control-label">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="photo" accept="image/*" class="custom-file-input form-control" id="photo">
                                           <img src=" <?php echo htmlentities($row['photo'] );  ?>" alt="" width="70px" height="70px">
                                        </div>
                                        
                                    </div>
        
                                 
        
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Update</button>
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

<?PHP require_once("includes/bottomfooter.php"); ?>
<script>
    $(function($) {
        $(".js-states").select2();
        $(".js-states-limit").select2({
            maximumSelectionLength: 2
        });
        $(".js-states-hide").select2({
            minimumResultsForSearch: Infinity
        });
    });
</script>