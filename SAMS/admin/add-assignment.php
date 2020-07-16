
<?php require_once("includes/toheader.php"); ?>
<?php
 
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
     $id = strtoupper($id);
   
    $marks = $_POST['marks'];
    $department = $_POST['department'];
    $classid = $_POST['class'];
    $subject = $_POST['subject'];
    $assigned_date = $_POST['assigned_date'];
    $due_date = $_POST['due_date'];
    $master = $_POST['master'];
     
    
    
    if($_FILES['file']['name'] != ""){
        $type = $_FILES["file"]["type"];
        if($type == "application/pdf") {
            // we add the time() function beacuse may be the name is same.
            // they will replace one another.
        $path = "../assignments/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $path); 
        }else{
            header("Location:add-assignment.php?filetype=incorrect");
            exit(); // to skip the follow code 
        }
    } 

    
    
    // $sql = "INSERT INTO  tblstudents(StudentName,RollId,StudentEmail,Gender,ClassId,DOB,Status) 
    // VALUES(:studentname,:roolid,:studentemail,:gender,:classid,:dob,:status)";

    $sql = "INSERT INTO `assigned_assignments`(`assignment_id`, `assignment_name`, `marks`, `subject_code`, `class_name`,
    `department`, `assigned_date`, `due_date`, `assignment_file`, `lecturer`) VALUES
    (:id, :name, :marks, :subject, :class, :department, :assign, :due, :file, :master)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_INT);
    $query->bindParam(':marks', $marks, PDO::PARAM_STR);
    $query->bindParam(':class', $classid, PDO::PARAM_INT);
    $query->bindParam(':subject', $subject, PDO::PARAM_STR);
    $query->bindParam(':department', $department, PDO::PARAM_STR);
    $query->bindParam(':assign', $assigned_date, PDO::PARAM_STR);
    $query->bindParam(':due', $due_date, PDO::PARAM_STR);
    $query->bindParam(':file', $path, PDO::PARAM_STR);
    $query->bindParam(':master', $master, PDO::PARAM_STR); 


    ;
    $lastInsertId = $dbh->lastInsertId($roolid);
    if ($query->execute()) {
        $msg = "Assignemtn info added successfully";
    } else {
        $error =  "Something went wrong. Please try again";
       print_r($query->errorInfo());
       exit();
    }
} 
?>

<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php'); ?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">
        <?php include('includes/leftbar.php'); ?>

<div class="main-page">

    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h2 class="title">Assignment Admission</h2>

            </div>

            <!-- /.col-md-6 text-right -->
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                    <li class="active">Assignment Admission</li>
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
                            <h5>Fill the Assignment info</h5>
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

                            <?php if(isset($_GET['filetype'])){ ?>
                        <div class="alert alert-danger left-icon-alert" role="alert">
                                <strong>Oh snap! Incorrect file type!</strong> <?php echo htmlentities(" Pleaase Choose File with (.pdf) Extension!"); ?>
                            </div>
                            
                            <?php } ?>

                        <form class="form-horizontal" method="post" enctype="multipart/form-data">

                        <div class="form-group has-success">
                                <label for="default" class="col-sm-2 control-label">Assignment ID</label>
                                <div class="col-sm-10">
                                    <input type="text" name="id" class="form-control" id="rollid" maxlength="5" required="required" autocomplete="on">
                                    <span class="help-block">Eg- <strong>FMC</strong>(<strong>F</strong> -> First(no of assignment), <strong>M</strong>-> Layout(assignment name), <strong>C</strong>-> C# (subject name))</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Assignment Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="fullanme" required="required" autocomplete="on">
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Marks</label>
                                <div class="col-sm-10">
                                    <input type="number" name="marks" class="form-control"  required="required" autocomplete="on">
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
                                <label for="default" class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <select name="subject" class="form-control" id="default" required="required">
                                        <option value="">Select Subject</option>
                                        <?php $sql = "SELECT subject_code, subject_name from subjects";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {   ?>
                                                <option value="<?php echo htmlentities($result->subject_code); ?> ">
                                                <?php echo htmlentities($result->subject_name); ?> 
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                    </div>
                            
                           

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Assigned Date</label>
                                <div class="col-sm-10">
                                    <input type="date" value="<?php echo date("Y-m-d"); ?>" name="assigned_date"  class="form-control">  
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Due Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="due_date"  class="form-control">  
                                    
                                </div>
                            </div>

                            

                            <div class="form-group has-success">
                                <label for="file" class="col-sm-2 control-label">Assignemnt File</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" accept="application/pdf" class="custom-file-input form-control" >
                                    <span  class="help-block">Choose Fiel With (.pdf) Extension.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lecturer" class="col-sm-2 control-label">Master Fullname</label>
                                <div class="col-sm-10">
                                <input type="text" name="master" id="lecturer" class="form-control" required placeholder="Teacher Full Name">
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
    <!-- /.col-md-6 -->

</div>
<!-- /.row -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- /.main-wrapper -->

<?php require_once("includes/bottomfooter.php"); ?>