<?php

 require_once("includes/toheader.php");

if (isset($_POST['date'])) {
    $name = $_POST['name'];
   
    $department = $_POST['department'];
  
    $section = $_POST['section'];
   
    $date = $_POST['date'];
 
    $sql = "INSERT INTO `classes`(`class_name`, `section_name`, `department`, `creation_date`) VALUES 
    (:classname, :section, :department, :date)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':classname', $name, PDO::PARAM_STR);
    $query->bindParam(':section', $section, PDO::PARAM_STR);
    $query->bindParam(':department', $department, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);

     
    if ($query->execute()) {
        $msg = "Class Created successfully!";
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


<!-- ========== LEFT SIDEBAR ========== -->
<?php include('includes/leftbar.php'); ?>
<!-- /.left-sidebar -->

<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h2 class="title">Create Student Class</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Classes</a></li>
                    <li class="active">Create Class</li>
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
                                <h5>Create Student Class</h5>
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
                                            <option value="">Select Class Name</option>
                                            <option value="1">First</option>
                                            <option value="2">Second</option>
                                            <option value="3">Third</option>
                                            <option value="4">Fourth</option>
                                        </select>
                                    </div>
                                </div>


                              

                                <div class="form-group">
                                    <label for="default" class=" control-label">Section Name</label>
                                    <div class="">
                                        <select name="section" class="form-control" id="default" >
                                        <option value="">Select Section Name</option>
                                        <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="control-label">Department</label>
                                    <div class="">
                                        <select name="department" class="form-control" id="default">
                                        <option value="">Select Department</option>    
                                        <option >Software Engineering</option>
                                            <option>Database</option> 
                                            <option >Networking</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="default" class=" control-label">Creation Date</label>
                                    <div class="">
                                        <input type="date" name="date" class="form-control" required>
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
<!-- /.content-container -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- /.main-wrapper -->
<?php require_once("includes/bottomfooter.php"); ?>