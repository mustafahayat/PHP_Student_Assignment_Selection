<?php

require_once("includes/toheader.php");

if (!empty($_POST['condidate_id'])) {
    $student = $_SESSION['slogin'];
    $assignment = $_POST['assignment_id'];
    

    $sql = "INSERT INTO `voters`(`assignment_id`, `student_rollno`, `vote_date`, `condidate_id`) VALUES
    (:assignment, :student, CURDATE(), :condidate); ";

    $query = $dbh->prepare($sql);

    foreach($_POST['condidate_id'] as $condidate){
        

    
    $query->bindParam(':condidate', $condidate, PDO::PARAM_STR);
    $query->bindParam(':assignment', $assignment, PDO::PARAM_STR);
    $query->bindParam(':student', $student, PDO::PARAM_STR);


    if ($query->execute()) {
        $msg = "Condidate Selected successfully!";
        $sql = "SELECT COUNT(student_rollno) AS vote FROM voters WHERE condidate_id = $condidate";
    $result = $dbh->query($sql);
   
    $sql1 = "UPDATE  condidates SET total_votes =".$result->fetchColumn() ." WHERE condidate_id = $condidate " ;
    $dbh->exec($sql1);

    } else {
        $error = "Something went wrong. Please try again!";
        
    }
    
    // $sql = "INSERT INTO condidates (total_votes) VALUES  (SELECT COUNT(student_rollno) WHERE condidate_id = $condidate); ";
}// end of the foreach loop
}// end of the isEmpty();
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
                <h2 class="title">Give Vote</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Voters</a></li>
                    <li class="active">Give Vote To Condidates</li>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
        <div class="container-fluid">





            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Condidates Info</h4>
                                
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

                        <div class="panel-body row">
                        
                        <table id="example" class="display table table-striped table-responsive table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Condidate ID</th>
                                                <th>Assignment ID</th>
                                                <th>Voter RollNo</th>
                                                <th>Vote Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Condidate ID</th>
                                                <th>Assignment ID</th>
                                                <th>Voter RollNo</th>
                                                <th>Vote Date</th> 
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- select assignment_name from assigned_assignments where not exists (select date 
                                        from done_assignments where assigned_assignments.assignment_id = done_assignments.assignment_id );          -->
                                            <?php
                                            
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($dbh->query("SELECT *FROM voters") as $row) {   ?>
                                                    <tr>
                                                        <td><?php echo $cnt;  ?></td>
                                                        <td><?php echo htmlentities($row['condidate_id']);  ?></td>
                                                        <td><?php echo htmlentities($row['assignment_id']);  ?></td>
                                                        <td><?php echo htmlentities($row['student_rollno']);  ?></td>
                                                        <td><?php echo htmlentities($row['vote_date']);  ?></td>
                                                       

                                                        <td><?php echo htmlentities($row->lefts) >= 0  ? "<span class='fa fa-pen-alt text-success'>Active</span>" : "<span class='fa fa-times-circle text-danger'> Expired</span>;"  ?></td>
                                                        <td><?php echo htmlentities($row->due_date); ?></td>
                                                        <td><span class="fa fa-file-alt" title="<?php echo $row->assignment_file; ?>" </span> </td> <td><?php echo htmlentities($row->lecturer); ?></td>

                                                        <td>
                                                            <a href="edit-assignment.php?id=<?php echo htmlentities($row->assignment_id); ?>"><i class="fa fa-edit" title="Edit Record"></i> </a>
                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>


                                        </tbody>
                                    </table>


                            <!-- /.col-md-12 -->
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

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content" id="data1">
            
        </div>
    </div>
</div>

