<?php

 require_once("includes/toheader.php");
    $classVal = intval($_GET['class']);
    $departmentVal = strval($_GET['department']);
    $subjectVal = strval($_GET['code']);
    
    $sql1 = "SELECT *FROM subject_class WHERE class_name = :classval AND department = :departmentval AND subject_code= :subjectval";
    $statment = $dbh->prepare($sql1);
    $statment->bindParam(':classval', $classVal, PDO::PARAM_INT);
    $statment->bindParam(':departmentval', $departmentVal, PDO::PARAM_STR);
    $statment->bindParam(':subjectval', $subjectVal, PDO::PARAM_STR);
    $statment->execute();
    $row = $statment->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['date'])) {
    $class = $_POST['class'];
   
    $department = $_POST['department'];
  
    $subject = $_POST['subject'];
   $status = $_POST['status'];
    $date = $_POST['date'];
 
    $sql = "UPDATE `subject_class` SET class_name = : classname, department = :department, subject_code = :subject_code,
     `status` = :status, creation_date = :date
    WHERE `subject_class`.`class_name` = :classval AND `subject_class`.`department` = :departmentval 
    AND `subject_class`.`subject_code` = :subjectval;";

    $query = $dbh->prepare($sql);
    $query->bindParam(':classval', $classVal, PDO::PARAM_INT);
    $query->bindParam(':departmentval', $departmentVal, PDO::PARAM_STR);
    $query->bindParam(':subjectval', $subjectVal, PDO::PARAM_STR);

    $query->bindParam(':classname', $class, PDO::PARAM_INT);
    $query->bindParam(':department', $department, PDO::PARAM_STR);
    $query->bindParam(':subject_code', $subject, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_INT);

     
    if ($query->execute()) {
        $msg = "Subject-Class Updated successfully!";
        header("location: manage-subjectcombination.php?msg=". $msg);
    } else {
        $error = "Something went wrong. Please try again! i will correct the error later!";
        print $error;
        print_r($query->errorInfo());
        exit();
    }
}
?>
<style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
</style>
</head>

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
                <h2 class="title">Edit Class-Subject Combination</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Classes</a></li>
                    <li class="active">Edit Class-Subject Combination</li>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
        <div class="container-fluid">





            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Edit Class-Subject Combination</h5>
                            </div>
                        </div>
                        <?php if ($msg) { ?>
                            <div class="alert alert-success left-icon-alert" role="alert">
                                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                            </div><?php } else if ($error) { ?>
                            <div class="alert alert-danger left-icon-alert" role="alert">
                                <strong>Oh snap!</strong> <?php  echo htmlentities($error); ?>
                            </div>
                        <?php } ?>

                        <div class="panel-body">

                            <form method="post">
                            <div class="form-group">
                                <label for="default" class=" control-label">Class</label>
                                <div class="">
                                    <select name="class" class="form-control" id="default" required="required">
                                       
                                       <option><?php if($row['class_name'] == 1) echo "First";
                                                            else if($row['class_name'] == 2) echo "Second";
                                                            else if($row['class_name'] == 3) echo "Third";
                                                            else echo "Fourth"; ?></option>

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
                                <label for="default" class=" control-label">Department</label>
                                <div class="">
                                    <select name="department" class="form-control" id="default" required="required">
                                        <option > <?php echo $row['department'];   ?></option>
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
                                <label for="default" class=" control-label">Subject</label>
                                <div class="">
                                    <select name="subject" class="form-control" id="default" required="required">
                                        <option> <?php echo $row['subject_code'];   ?></option>
                                        <?php $sql = "SELECT subject_code, subject_name  from subjects";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {   ?>
                                                <option value="<?php echo $result->subject_code; ?>">
                                                    <?php   echo $result->subject_name; ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                        <label for="default" class=" control-label">Status</label>
                                        <div class="">
                                            <?php if($row['status'] == 1){ ?>
                                            <input type="radio"  name="status" value="1" required="required" checked=""> Active 
                                            <input type="radio" name="status" value="0" required="required">Deactive 
                                            <?php }else{ ?>    
                                            <input type="radio" name="status" value="1" required="required" > Active                                    
                                            <input type="radio" name="status" value="0" required="required" checked="">Deactive 
                                            <?php } ?>
                                        </div>
                            </div>

                                <div class="form-group">
                                    <label for="default" class=" control-label">Creation Date</label>
                                    <div class="">
                                        <input type="date" value="<?php echo $row['creation_date'];   ?>" name="date" class="form-control">
                                    </div>
                                </div>


                                <div class="">
                                    <button type="submit" name="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                </div>



                            </form>


                        </div>
                    </div>
                </div>
                <!-- /.col-md-8 col-md-offset-2 -->
            </div>
            <!-- /.row -->




        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.section -->

</div>
<!-- /.main-page -->
</div>
    <!-- /.col-md-6 -->

</div>
<!-- /.row -->
</div>
<!-- /.content-container -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- /.main-wrapper -->
<?php require_once("includes/bottomfooter.php"); ?>