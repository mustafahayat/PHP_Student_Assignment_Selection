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
                        <h2 class="title">Manage Students</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Students</li>
                            <li class="active">Manage Students</li>
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
                                        <h5>View Students Info</h5>
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
                                                <th>Student Name</th>
                                                <th>Roll Id</th>
                                                <th>Department</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Register_Date</th>
                                                <th>Status</th>
                                                <th>Photo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Roll Id</th>
                                                <th>Department</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Register_Date</th>
                                                <th>Status</th>
                                                <th>Photo</th>
                                                <th>Action</th>
                                                 
                                            </tr>
                                        </tfoot>
                                        <tbody>                
                                            <?php //$sql = "SELECT students.student_rollno, students.fullname, students.department, students.photo, students.status, students.email, classes.class_name, classes.section_name FROM students inner join classes on students.class_name = classes.class_name and students.section_name = classes.section_name;";
                                            $sql = "SELECT * FROM students ORDER BY student_rollno ;";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {   ?>
                                                    <tr>
                                                        <td><?php echo $cnt;  ?></td>
                                                        <td><?php echo htmlentities($row->fullname);  ?></td>
                                                        <td><?php echo htmlentities($row->student_rollno);  ?></td>
                                                        <td><?php echo htmlentities($row->department);  ?></td>
                                                        <td><?php echo htmlentities($row->class_name);  ?></td>
                                                        <td><?php echo htmlentities($row->section_name);  ?></td>
                                                        <td><?php echo htmlentities($row->email); ?></td>
                                                        <td><?php echo htmlentities($row->status) == 1 ? "Active" : "Removed";  ?></td> 
                                                        <td><img src="<?php echo htmlentities($row->photo);  ?>" alt="img" width="40px" height="40px" class="img-circle"></td>
                                                        
                                                        <td>
                                                            <a href="edit-student.php?stid=<?php echo htmlentities($row->student_rollno); ?>"><i class="fa fa-edit" title="Edit Record"></i> </a>
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