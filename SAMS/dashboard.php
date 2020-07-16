<?php require_once("includes/toheader.php"); ?>
<?php

//===================================================================
// To Store the Result When The Time is Expired!!
foreach ($dbh->query("SELECT assignment_id FROM condidates") as $row) {

    $sql = "INSERT INTO `result`(`condidate_id`, `assignment_id`, `election_round`, `total_votes`, `annoced_date`) 
    SELECT condidate_id, assignment_id, election_round, total_votes, CURDATE() FROM condidates 
    WHERE total_votes = (SELECT MAX(total_votes) FROM condidates WHERE assignment_id = " . $row['assignment_id'] . "  ) AND DATEDIFF(expire_date, CURDATE()) < 0 AND  assignment_id = " . $row['assignment_id'] . " ;
    DELETE FROM condidates WHERE DATEDIFF(expire_date, CURDATE()) < 0 AND assignment_id = " . $row['assignment_id'] . " ;";

    $dbh->query($sql);
}

// End Of the Storing The Result!
//===================================================================

?>
<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php'); ?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">
        <?php include('includes/leftbar.php'); ?>

<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Dashboard</h2>

            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-primary" href="manage-students.php">
                        <?php
                        $sql1 = "SELECT student_rollno from students ";
                        $query1 = $dbh->prepare($sql1);
                        $query1->execute();
                        // $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                        $totalstudents = $query1->rowCount();
                        ?>

                        <span class="number counter"><?php echo htmlentities($totalstudents); ?></span>
                        <span class="name">Regd Students</span>
                        <span class="bg-icon"><i class="fa fa-users"></i></span>
                    </a>
                    <!-- /.dashboard-stat -->
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-warning" href="manage-condidates.php">
                        <?php
                        $sql = "SELECT condidate_id, assignment_id from  condidates ";

                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetch(PDO::FETCH_ASSOC);
                        $totalsubjects = $query->rowCount();
                        
                        ?>
                         
                        <input type="hidden" name="assignment_id" value="<?php echo $results['assignment_id']; ?>"
                         id="id"> 

                        <span class="number counter"><?php echo htmlentities($totalsubjects); ?></span>
                        <span class="name">No. Of Condidate</span>
                        <span class="bg-icon"><i class="fa fa-crown"></i></span>
                    </a>
                    <!-- /.dashboard-stat -->
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-danger" href="manage-assignment.php">
                        <?php
                        
                        $sql2 = "SELECT assignment_id FROM assigned_assignments 
                        where not exists (select date from done_assignments where 
                        assigned_assignments.assignment_id = done_assignments.assignment_id AND student_rollno = :roll) " ;
                         
                         
                     
                        // $sql2 = "SELECT assignment_id from  assigned_assignments ";
                        $query2 = $dbh->prepare($sql2);
                        $query2->bindParam(':roll', $_SESSION['slogin'], PDO::PARAM_STR);
                        $query2->execute();
                        // $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                        $totalclasses = $query2->rowCount();
                        ?>
                        <span class="number counter"><?php echo htmlentities($totalclasses); ?></span>
                        <span class="name">Total Assigned Assignment</span>
                        <span class="bg-icon"><i class="fa fa-bank"></i></span>
                    </a>
                    <!-- /.dashboard-stat -->
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-success" href="done-assignment.php">
                        <?php
                           $sql3 = "SELECT assignment_id FROM done_assignments
                           WHERE  student_rollno = :roll ;";

                         $query3 = $dbh->prepare($sql3);
                        $query3->bindParam(':roll', $_SESSION['slogin'], PDO::PARAM_STR);

                        // $sql3 = "SELECT  assignment_id from  done_assignments ";
                        
                        $query3->execute();
                        // $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                        $totalresults = $query3->rowCount();
                        ?>

                        <span class="number counter"><?php echo htmlentities($totalresults); ?></span>
                        <span class="name">No. of Done Assignment</span>
                        <span class="bg-icon"><i class="fa fa-check"></i></span>
                    </a>
                    <!-- /.dashboard-stat -->
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.section -->

    <!-- ======================================================== -->
    <div class="container-fluid">
        <div class="row page-title-div">
            <!-- Jsut TO Give Space -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shadow-lg">

                    <span class="mb-3">Current Condidate Votes State</span>
                    <a class="dashboard-stat bg-white" href="#">

                        <canvas id="canvas" height="80px" width="auto"></canvas>

                    </a> <!-- /.dashboard-stat -->
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <!-- <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                    <span class="mb-3">Recently Election Result</span>
                    <a class="dashboard-stat bg-white text-dark " href="">

                        <canvas id="canvas1" height="100px" width="auto"></canvas>

                    </a> -->
                    <!-- /.dashboard-stat -->
                <!-- </div> -->
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

            </div>
        </div>
    </section>



    <!-- ============================================================= -->

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

<!-- //======================================================= -->



<script src="js/chart1.js"></script>




<script>
    </script>
<!-- </body>
</html> -->

<script>
     var assignment_id = $("#id").val();
    //  alert("The Id is: "+ assignment_id);

    $.post("data.php", "assignment_id="+assignment_id,
            function(data) {
                console.log(data);
                var name = [];
                var votes = [];

                for (var i in data) {
                    name.push(data[i].condidate_name);

                    votes.push(data[i].total_votes);

                }
                // console.log(name);
                // console.log(votes);
                
            
    // Barchart Data For The Recently (prviouse result data)
    var barChartData = {
        labels: name,
        datasets: [{
                fillColor: "tomato",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: votes
            }
        ]
    }
    
    // var barChartData1 = {
    //     labels: name,
    //     datasets: [{
    //             fillColor: "orange",
    //             strokeColor: "rgba(220,220,220,0.8)",
    //             highlightFill: "rgba(220,220,220,0.75)",
    //             highlightStroke: "rgba(220,220,220,1)",
    //             data: votes
    //         }
    //     ]
    // }
    
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
        responsive: true
    });

    // var ctx = document.getElementById("canvas1").getContext("2d");
    // window.myBar = new Chart(ctx).Bar(barChartData1, {
    //     responsive: true
    // });
    
});

</script>