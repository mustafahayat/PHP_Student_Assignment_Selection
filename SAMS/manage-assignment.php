<?php require_once("includes/toheader.php"); ?>


<?php
    if(isset($_POST['assignment_id'])){
        $student_roll = $_SESSION['slogin'];
        
        $assignment_id = $_POST['assignment_id'];
        
    if($_FILES['file']['name'] != ""){
        $type = $_FILES["file"]["type"];
        if($type == "application/pdf") {
            // we add the time() function beacuse may be the name is same.
            // they will replace one another.
        $path = "done_assignments/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $path); 
        }else{
            header("Location:manage-assignment.php?filetype=incorrect");
            exit(); // to skip the follow code 
        }
    } 

        $sql1 = "INSERT INTO `done_assignments`(`assignment_id`, `student_rollno`, `date`, `done_assignment_file`) VALUES
                (:id, :roll, CURDATE(), :file)";
        $statment = $dbh->prepare($sql1);
        $statment->bindParam(':id', $assignment_id, PDO::PARAM_STR);
        $statment->bindParam(':roll', $student_roll, PDO::PARAM_STR);
        $statment->bindParam(':file', $path, PDO::PARAM_STR);
        if($statment->execute()){
            $msg = "Your Work Added successfully!";
        }else{
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
                        <h2 class="title">Manage Assignemnts</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Assignemnts</li>
                            <li class="active">Manage Assignemnts</li>
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
                                        <h5>View Assignemnts Info</h5>
                                          
                                            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger pull-right" style="color: white"><i class="fa fa-plus"></i> Add New Work</a>
                                        
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

                                <?php if(isset($_GET['filetype'])){ ?>
                        <div class="alert alert-danger left-icon-alert" role="alert">
                                <strong>Oh snap! Incorrect file type!</strong> <?php echo htmlentities(" Pleaase Choose File with (.pdf) Extension!"); ?>
                            </div>
                            
                            <?php } ?>


                                <div class="panel-body ">

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
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>File</th>
                                                <th>Master</th>
                                                
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
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>File</th>
                                                <th>Master</th>
                                                 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <!-- select assignment_name from assigned_assignments where not exists (select date 
                                        from done_assignments where assigned_assignments.assignment_id = done_assignments.assignment_id );          -->
                                            <?php
                                            
                                            
                                                $sql = "SELECT *, DATEDIFF(due_date, curdate()) as lefts FROM assigned_assignments 
                                            where not exists (select date from done_assignments where assigned_assignments.assignment_id = done_assignments.assignment_id AND student_rollno = :roll)  ;";
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
                                                        <td><?php echo htmlentities($row->subject_code); ?></td>

                                                        <td><?php echo htmlentities($row->lefts) >= 0  ? "<span class='fa fa-pen-alt text-success'>Active</span>" : "<span class='fa fa-times-circle text-danger'> Expired</span>;"  ?></td>
                                                        <td><?php echo htmlentities($row->due_date); ?></td>
                                                        <td><span class="fa fa-file-alt" title="<?php echo $row->assignment_file; ?>" </span> </td> <td><?php echo htmlentities($row->lecturer); ?></td>

                                                         
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
                                WHERE NOT EXISTS (SELECT *FROM done_assignments WHERE done_assignments.assignment_id = assigned_assignments.assignment_id AND student_rollno ='". $_SESSION['slogin']. "' ) 
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

