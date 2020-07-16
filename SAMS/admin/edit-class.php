<?php

 require_once("includes/toheader.php");
 $class = strval( $_GET['class']);
 $department =strval($_GET['department']); 
 
 $sql1 = "SELECT *FROM classes WHERE class_name = :class AND department = :department";
 $statment = $dbh->prepare($sql1);
 $statment->bindParam(':class', $class, PDO::PARAM_STR);
 $statment->bindParam(':department', $department, PDO::PARAM_STR);
 $statment->execute();
 $row = $statment->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['date'])) {
     
    $name = $_POST['name'];
    $section = $_POST['section'];
    $department1 = $_POST['department'];
    $date = $_POST['date'];
   
    $sql = "UPDATE  classes SET class_name = :classname, department = :department, section_name = :section,creation_date =  :date WHERE class_name = :class_name AND department = :department_name";
    $query = $dbh->prepare($sql);
    $query->bindParam('class_name', $class,PDO::PARAM_STR);
    $query->bindParam('department_name', $department, PDO::PARAM_STR);
    
    $query->bindParam(':classname', $name, PDO::PARAM_STR);
    $query->bindParam(':department', $department1, PDO::PARAM_INT);
    $query->bindParam(':section', $department1, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    
    // print $sql;
    // exit();
     
    if ($query->execute()) {
        $msg = "Class Updated successfully!";
        header("location: manage-class.php?msg=".$msg);
    } else {
        $error = "Something went wrong. Please try again!";
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
                <h2 class="title">Edit Student Class</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Classes</a></li>
                    <li class="active">Edit Class</li>
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
                                <h5>Edit Student Class</h5>
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
                                    <label for="default" class=" control-label">Class Name</label>
                                    <div class="">
                                        <select name="name" class="form-control" id="default" required="required">
                                            <option value="<?php echo htmlentities($row['class_name']); ?>"><?php echo htmlentities($row['class_name']); ?></option>
                                            <option value="1">First</option>
                                            <option value="2">Second</option>
                                            <option value="3">Third</option>
                                            <option value="4">Fourth</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="default" class="control-label">Department</label>
                                    <div class="">
                                        <select name="department" class="form-control" id="default" required="required">
                                            <option><?php echo htmlentities($row['department']); ?></option>    
                                            <option >Software Engineering</option>
                                            <option>Database</option> 
                                            <option >Networking</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="default" class=" control-label">Section Name</label>
                                    <div class="">
                                        <select name="section" class="form-control" id="default" required="required">
                                        <option value="<?php echo htmlentities($row['section_name']); ?>"><?php echo htmlentities($row['section_name']); ?></option>
                                        <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class=" control-label">Creation Date</label>
                                    <div class="">
                                        <input type="date" value="<?php echo htmlentities($row['creation_date']); ?>" name="date" class="form-control" required>
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