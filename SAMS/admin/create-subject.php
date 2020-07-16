<?php

 require_once("includes/toheader.php");

if (isset($_POST['code'])) {
    $code = $_POST['code'];
    $code = strtoupper($code);
    $name = $_POST['name'];
     
    $date = $_POST['date'];
    $sql = "INSERT INTO `subjects`(`subject_code`, `subject_name`, `creation_date`) VALUES
            (:code,:name, :date)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    
    
     
    if ($query->execute()) {
        $msg = "Subject Created successfully!";
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
                <h2 class="title">Subject Creation</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Subjects</a></li>
                    <li class="active">Create Subject</li>
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
                                <h5>Create Subject</h5>
                            </div>
                        </div>
                        <?php if ($msg) { ?>
                            <div class="alert alert-success left-icon-alert" role="alert">
                                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                            </div><?php } else if ($error) { ?>
                            <div class="alert alert-danger left-icon-alert" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                            </div>
                        <?php } ?>

                        <div class="panel-body">

                            <form method="post">
                                
                                <div class="form-group">
                                    <label for="default" class=" control-label">Subject Code</label>
                                    <div class="">
                                        <input type="text" name="code" class="form-control" required>
                                        <span class="help-block">Eg- <strong>CSF</strong> (<strong>C</strong> -> C Language(subject), <strong>S</strong>-> Software Endgineering(department), <strong>F</strong>-> First(year))</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class=" control-label">Subject Name</label>
                                    <div class="">
                                        <input type="text" name="name" class="form-control" required>
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