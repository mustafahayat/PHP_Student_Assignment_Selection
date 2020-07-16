<?php

require_once("includes/toheader.php");
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
                <h2 class="title">Manage Votes</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Voters</a></li>
                    <li class="active">Manage Votes</li>
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
                                <h4>Voter Votes Info</h4>
                                
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
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- select assignment_name from assigned_assignments where not exists (select date 
                                        from done_assignments where assigned_assignments.assignment_id = done_assignments.assignment_id );          -->
                                            <?php
                                            
                                                $cnt = 1;
                                                foreach ($dbh->query("SELECT *FROM voters") as $row) {   ?>
                                                    <tr>
                                                        <td><?php echo $cnt;  ?></td>
                                                        <td><?php echo htmlentities($row['condidate_id']);  ?></td>
                                                        <td><?php echo htmlentities($row['assignment_id']);  ?></td>
                                                        <td><?php echo htmlentities($row['student_rollno']);  ?></td>
                                                        <td><?php echo htmlentities($row['vote_date']);  ?></td>
                                                       
                                                        <td>
                                                            <a href="edit-votes.php?id=<?php echo htmlentities($row->assignment_id); ?>"><i class="fa fa-edit" title="Edit Record"></i> </a>
                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                             ?>


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

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content" id="data1">
            
        </div>
    </div>
</div>

