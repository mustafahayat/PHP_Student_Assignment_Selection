<?php

require_once("includes/toheader.php");

if (!empty($_POST['condidate_id'])) {
    $student = $_SESSION['alogin'];
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
        $sql = "SELECT COUNT(student_rollno) AS vote FROM voters WHERE condidate_id = '$condidate'";
    $result = $dbh->query($sql);
   
    $sql1 = "UPDATE  condidates SET total_votes =".$result->fetchColumn() ." WHERE condidate_id = '$condidate' " ;
    $dbh->query($sql1);
        $msg = "Welldone Condidate Selected Successfully!!";
     
        
    

    } else {
        $error = "Something went wrong. Please try again!";
        // print_r($query->errorInfo());
        // exit();
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
                                <p class="small">You Can Select Upto Five Condidates</p>
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
                            <?php
                                
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label for="assignment" class=" control-label">Please! Select Assignment Name First!</label>
                                    <div class="">
                                        <select name="assignment_id" class="form-control" id="assignment" required>
                                            <option value="">Select Assignment</option>
                                            <?php foreach ($dbh->query("SELECT DISTINCT assignment_id, (SELECT DISTINCT assignment_name FROM assigned_assignments WHERE assignment_id = main.assignment_id)as assignment_name FROM condidates as main") as $row) { ?>

                                                <option value="<?php echo $row['assignment_id']; ?>">
                                                    <?php echo $row['assignment_name'] ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div id="data">

                                </div>




         
                                    <button type="submit" name="submit" class="btn btn-success btn-labeled">Submit<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                 
                                
                                    <button type="reset" name="submit" class="btn btn-info btn-labeled ">Reset<span class="btn-label btn-label-right"><i class="fa fa-refresh"></i></span></button>
                                 
                            </form>

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


<script>
    $(document).ready(function(){
        
        $("#assignment").change(function(){
           var assignment_id = $(this).val();
        //    bootbox.alert(assignment_id);
           $.post("get-condidates.php", "id=" + assignment_id, function(data){
               $("#data").html(data);
           })

        });

         
     $(document).on("click", ".open-AddBookDialog", function () {
        var condidate_id = $(this).data('id');
         
        $.post("get-assignment.php", "condidate_id=" + condidate_id, function(data){
            // alert("The data: "+ data);
               $("#data1").html(data);
           })
     
     
     });
         

    });

     

</script>