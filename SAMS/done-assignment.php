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
                        <h2 class="title">Done Assignemnts</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Assignemnts</li>
                            <li class="active">Done Assignemnts</li>
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
                                        <h5>View Done Assignemnts Info</h>
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
                                
                                if(isset($_GET['msg'])){ ?>
                                    <div class="alert alert-success left-icon-alert" role="alert">
                                        <strong>Well done!</strong><?php echo $_GET['msg']; ?>
                                    </div>
                                <?php } ?>
                                
                                
                                <div class="panel-body p-20">

                                    <table id="example" class="display table table-striped table-responsive table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                                <th>Class</th>
                                                <th>Department</th>
                                                <th>Subject</th>
                                                <th>Student Name</th>
                                                <th>Due Date</th>
                                                <th>File</th>
                                                <th>Master</th>
                                                <th>Done Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                                <th>Class</th>
                                                <th>Department</th>
                                                <th>Subject</th>
                                                <th>Student Name</th>
                                                <th>Due Date</th>
                                                <th>File</th>
                                                <th>Master</th>
                                                <th>Done Date</th>                                            </tr>
                                        </tfoot>
                                        <tbody>       
                                            <?php 
                                            
                                            
                                                $sql = "SELECT main.*, assigned_assignments.* FROM done_assignments as main
                                                        INNER JOIN assigned_assignments ON main.assignment_id = assigned_assignments.assignment_id
                                                         
                                                        WHERE  student_rollno = :roll ;";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':roll', $_SESSION['slogin'], PDO::PARAM_STR);

                                            
                                            
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {   ?>
                                                    <tr>
                                                        <td><?php echo $cnt;  ?></td>
                                                        <td><?php echo htmlentities($row->assignment_id);  ?></td>
                                                        <td><?php echo htmlentities($row->assignment_name);  ?></td>
                                                        <td><?php echo htmlentities($row->marks);  ?></td>
                                                        <td><?php echo htmlentities($row->class_name);  ?></td>
                                                        <td><?php echo htmlentities($row->department);  ?></td>
                                                        <td><?php echo htmlentities($row->subject_name); ?></td>
                                                        <th><?php  echo htmlentities($row->fullname); ?></th>
                                                         
                                                        <td><?php echo htmlentities($row->due_date); ?></td>
                                                        <td><span class="fa fa-file-alt" title="<?php echo $row->assignment_file; ?>"</span></td>
                                                        <td><?php echo htmlentities($row->lecturer); ?></td>
                                                        <td><?php echo htmlentities($row->date); ?></td>
                                          
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