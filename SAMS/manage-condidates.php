<?php require_once("includes/toheader.php"); ?>

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
                        <h2 class="title">Manage Condidates</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Condidates</li>
                            <li class="active">Manage Condidates</li>
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
                                        <h5>View Condidates Info</h5>
                                        <small><h6><strong>Remember:</strong>Delete the Expired Election and Store the Result in the Database.</h6></small>
                                    </div>
                                </div>
                                <?php if ($msg) { ?>
                                    <div class="alert alert-success left-icon-alert" role="alert">
                                        <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                    </div><?php } else if ($error) { ?>
                                    <div class="alert alert-danger left-icon-alert" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                    </div>
                                <?php }

                                        if (isset($_GET['msg'])) { ?>
                                    <div class="alert alert-success left-icon-alert" role="alert">
                                        <strong>Well done!</strong><?php echo $_GET['msg']; ?>
                                    </div>
                                <?php } ?>


                                <div class="panel-body p-20">

                                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Condidate Name</th>
                                                <th>Condidate ID</th>
                                                <th>Photo</th>
                                                <th>Assignment Name</th>
                                                <th>Election Round</th>
                                                <th>Expire Date</th>                               
                                                 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Condidate Name</th>
                                                <th>Condidate ID</th>
                                                <th>Photo</th>
                                                <th>Assignment Name</th>
                                                <th>Election Round</th>
                                                <th>Expire Date</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $sql = "SELECT *, (SELECT fullname FROM students WHERE student_rollno = main.condidate_id)AS student_name, (SELECT photo FROM students WHERE student_rollno = main.condidate_id)AS photo, (SELECT assignment_name FROM assigned_assignments WHERE assignment_id = main.assignment_id) AS assignment_name FROM condidates AS main WHERE DATEDIFF(expire_date, curdate()) >= 0";
                                            /*
                                                Here I have to delete the Expired Election
                                                Remember to Store the Result of the Expired Election n the Result Table.
                                                I have to do this.


                                            */
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {  
                                                    $photo = ltrim($result->photo, " ../ "); ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo  htmlentities($result->student_name); ?></td>
                                                        <td><?php echo htmlentities($result->condidate_id); ?></td>
                                                        <td><img src="<?php echo $photo; ?>" alt="student" width="40px" height="40px" class="img-circle"></td>
                                                        <td><?php echo htmlentities($result->assignment_name); ?></td>
                                                        <td><?php echo htmlentities($result->election_round); ?></td>
                                                        <td><?php echo htmlentities($result->expire_date); ?></td>
                                                        
                                                         
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
                        <!-- /.col-md-6 -->


                    </div>
                    <!-- /.col-md-12 -->
                </div>
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-md-6 -->

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

<?php require("includes/bottomfooter.php"); ?>
<script>
    $(function($) {
        $('#example').DataTable();

        $('#example2').DataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false
        });

        $('#example3').DataTable();
    });
</script>