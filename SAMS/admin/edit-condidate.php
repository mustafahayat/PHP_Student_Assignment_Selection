<?php

 require_once("includes/toheader.php");
 $condidate_id = intval($_GET['condidate']);
 $assignment_id = intval($_GET['assignment']);
 $election_round = intval($_GET['election']);

 $sql1 = "SELECT *, (SELECT fullname FROM students WHERE student_rollno = main.condidate_id)AS student_name, (SELECT assignment_name FROM assigned_assignments WHERE assignment_id = main.assignment_id) AS assignment_name FROM condidates AS main
  WHERE condidate_id = :condidate_id AND assignment_id = :assignment_id AND election_round = :election_round";
 $statment = $dbh->prepare($sql1);

 $statment->bindParam(':condidate_id', $condidate_id, PDO::PARAM_INT);
 $statment->bindParam(':assignment_id', $assignment_id, PDO::PARAM_INT);
 $statment->bindParam(':election_round', $election_round, PDO::PARAM_INT);

 $statment->execute();
 $row1 = $statment->fetch(PDO::FETCH_ASSOC);
 
if (isset($_POST['submit'])) {
    $condidate = $_POST['student_id'];
   
    $assignment = $_POST['assignment_id'];
  
    $round = $_POST['election_round'];
    $date = $_POST['date'];
   
    
    $sql = "UPDATE condidates SET condidate_id = :condidate, assignment_id = :assignment, election_round = :election, expire_date = :date
    WHERE condidate_id = :condidate_id AND assignment_id = :assignment_id AND election_round = :election_round";

    $query = $dbh->prepare($sql);

        
    $query->bindParam(':condidate_id', $condidate_id, PDO::PARAM_INT);
    $query->bindParam(':assignment_id', $assignment_id, PDO::PARAM_INT);
    $query->bindParam(':election_round', $election_round, PDO::PARAM_INT);
    
    
    $query->bindParam(':condidate', $condidate, PDO::PARAM_STR);
    $query->bindParam(':assignment', $assignment, PDO::PARAM_STR);
    $query->bindParam(':election', $round, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);

     
    if ($query->execute()) {
        $msg = "Condidate Updated successfully!";
        header("location: manage-condidates.php?msg=". $msg);
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
                <h2 class="title">Edit Condidate</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Condidate</a></li>
                    <li class="active">Edit Condidate</li>
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
                                <h5>Edit Condidate</h5>
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
                                    <label for="default" class=" control-label">Student Fullname</label>
                                    <div class="">
                                    
                                        <select name="student_id" class="form-control" id="default" required="required">
                                            <option value="<?php echo $row1['condidate_id']; ?>"><?php echo $row1['student_name']; ?></option>
                                            <?php  foreach($dbh->query("SELECT student_rollno, fullname FROM students") as $row){ ?>
                                                
                                                <option value="<?php echo $row['student_rollno']; ?>">
                                                <?php echo $row['fullname'] ?></option>
                                                
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>


                              

                                <div class="form-group">
                                    <label for="default" class=" control-label">Assignment Name</label>
                                    <div class="">
                                        <select name="assignment_id" class="form-control" id="default" required>
                                        <option value="<?php echo $row1['assignment_id']; ?>">  <?php echo $row1['assignment_name']; ?></option>
                                            <?php  foreach($dbh->query("SELECT assignment_id, assignment_name FROM assignments") as $row){ ?>
                                                    
                                                    <option value="<?php echo $row['assignment_id']; ?>">
                                                    <?php echo $row['assignment_name'] ?></option>
                                                    
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="control-label">Election Round</label>
                                    <div class="">
                                        <select name="election_round" class="form-control" id="default" required>
                                        <option value="<?php echo $row1['election_round']; ?>">
                                                <?php
                                                    if($row1['election_round'] == 1) echo "First";
                                                    else if($row1['election_round'] == 2) echo "Second";
                                                    else echo "Third";
                                                ?>
                                        </option>    
                                        <option value="1">First</option>
                                            <option value="2">Second</option> 
                                            <option value="3">Third</option>
                                        </select>

                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <label for="default" class="control-label">Expire Date</label>
                                    <input type="date" value="<?php echo $row1['expire_date'] ?>" name="date" id="date" class="form-control">
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