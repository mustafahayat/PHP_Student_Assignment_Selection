<?php

 require_once("includes/toheader.php");

if (isset($_POST['submit'])) {
    $condidate = $_POST['student_id'];
   
    $assignment = $_POST['assignment_id'];
  
    $round = $_POST['election_round'];
    $date = $_POST['date'];

   
    
    $sql = "INSERT INTO `condidates`(`condidate_id`, `assignment_id`, `election_round`,    `expire_date`) VALUES 
    (:condidate, :assignment, :election, :date)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':condidate', $condidate, PDO::PARAM_STR);
    $query->bindParam(':assignment', $assignment, PDO::PARAM_STR);
    $query->bindParam(':election', $round, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);

     
    if ($query->execute()) {
        $msg = "Condidate Added successfully!";
    } else {
        $error = "Something went wrong. Please try again!";
        // print_r($query->errorInfo());
        // exit();
        
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
                <h2 class="title">Add Condidate</h2>
            </div>

        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-md-6">
                <ul class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#">Condidate</a></li>
                    <li class="active">Add Condidate</li>
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
                                <h5>Add New Condidate</h5>
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
                                    <label for="assignment" class=" control-label">Assignment Name</label>
                                    <div class="">
                                        <select name="assignment_id" class="form-control" id="assignment" required>
                                         <option value="">Select Assignment</option>
                                            <?php  foreach($dbh->query("SELECT DISTINCT assignment_id, (SELECT DISTINCT assignment_name FROM assigned_assignments WHERE assignment_id = main.assignment_id)as assignment_name FROM done_assignments as main") as $row){ ?>
                                                    
                                                    <option value="<?php echo $row['assignment_id']; ?>">
                                                    <?php echo $row['assignment_name'] ?></option>
                                                    
                                            <?php } ?> 
                                        </select>
                                    </div>
                                </div>


                            <div id="data">
                               
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

<script>
    $(document).ready(function(){
        
        $("#assignment").change(function(){
           var assignment_id = $(this).val();
        //    bootbox.alert(assignment_id);
           $.post("get-assignment.php", "id=" + assignment_id, function(data){
                
               if(parseInt(data) == 1)
               {
                   bootbox.alert({
                       size : "large",
                       title : "Alert",
                       message : "There is Already Running Election on Named Assignment!"
                   });
               }{
               $("#data").html(data);
               }
           })

        })
    })
</script>