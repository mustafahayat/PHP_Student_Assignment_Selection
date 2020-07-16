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
                        <h2 class="title">Manage Results</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Results</li>
                            <li class="active">Manage Results</li>
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
                                        <h5>All Election Results Info</h5> 
                                    </div>
                                </div>
                                 
                            
                             


                                <div class="panel-body ">

                                    <table id="example" class="display table table-striped table-responsive table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Condidate Name</th>
                                                <th>Condidate Photo</th>
                                                <th>Assignment Name</th>
                                                <th>Master Name</th>
                                                <th>Total Votes</th>
                                                <th>Annoced Date</th>
                                                 
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Condidate Name</th>
                                                <th>Condidate Photo</th>
                                                <th>Assignment Name</th>
                                                <th>Master Name</th>
                                                <th>Total Votes</th>
                                                <th>Annoced Date</th>
                                                 
                                                 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                            <?php
                                            
                                                $sql = "SELECT result.*,students.fullname, students.photo, assigned_assignments.assignment_name, 
                                                assigned_assignments.lecturer FROM result
                                                INNER JOIN students ON result.condidate_id = students.student_rollno
                                                INNER JOIN assigned_assignments ON result.assignment_id = assigned_assignments.assignment_id";
                                                $query = $dbh->prepare($sql);
                                             
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {   ?>
                                                    <tr>
                                                        <td><?php echo $cnt;  ?></td>
                                                        <td><?php echo htmlentities($row->fullname);  ?></td>
                                                        <td class="text-center"><img src="<?php echo htmlentities($row->photo);  ?>" class="img-circle" alt="student" width="50px" height="50px"></td>
                                                        <td><?php echo htmlentities($row->assignment_name);  ?></td>
                                                        <td><?php echo htmlentities($row->lecturer);  ?></td>
                                                        <td><?php echo htmlentities($row->total_votes);  ?></td>
                                                        <td><?php echo htmlentities($row->annoced_date); ?></td>

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



<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add Your New Work</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="default" class="control-label">Assignment Name</label>
                        <div class="">
                            <select name="assignment_id" class="form-control" id="default">
                                <option value="">Select Assignment Name</option>
                                <?php $sql2 = "SELECT assignment_id, assignment_name FROM assigned_assignments 
                                WHERE NOT EXISTS (SELECT *FROM done_assignments WHERE done_assignments.assignment_id = assigned_assignments.assignment_id AND student_rollno =". $_SESSION['alogin']. " ) 
                                and DATEDIFF(due_date, curdate()) >=0"; 
                                    
                                ?>

                                <?php foreach ($dbh->query($sql2) as $row) { ?>
                                   
                                <option value="<?php echo $row['assignment_id'] ?>">
                                <?php  echo $row['assignment_name'] ?></option>

                              <?php  } ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="default" class=" control-label">Your Assignment File</label>
                        <div class="">
                            <input type="file" name="file" class="form-control" accept="application/pdf" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Add Work" class=" btn btn-success">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

