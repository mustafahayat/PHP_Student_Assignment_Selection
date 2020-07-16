<?php 
    require_once("config.php");
    
        $sql = "SELECT  * FROM users WHERE username = :rollno";
    $statment = $dbh->prepare($sql);
    $statment->bindParam(':rollno', $_SESSION['alogin'], PDO::PARAM_STR);
     
    $statment->execute();
    
    // $results = $statment->fetch(PDO::FETCH_ASSOC);
    
    $results = $statment->fetch(PDO::FETCH_ASSOC);
     
?>
<div class="left-sidebar bg-black-300 box-shadow ">
    <div class="sidebar-content">
        <div class="user-info closed">
           
           
            <img src="<?php echo $results['photo'] ?>" alt="<?php echo $results['fullname'] ?>" class="img-circle profile-img" width="50px" height="50px">
            <h6 class="title"><?php echo $results['fullname'] ?></h6>
            <small class="info"><?php echo "System Admin" ?> </small>
         

        </div>
        <!-- /.user-info -->

        <div class="sidebar-nav">
            <ul class="side-nav color-gray">
                <li class="nav-header">
                    <span class="">Main Category</span>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> <span>Dashboard</span> </a>

                </li>

                <li class="nav-header">
                    <span class="">Appearance</span>
                </li>
                <li class="has-children">
                    <a href="#"><i class="fa fa-school"></i> <span>Student Classes</span> <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li><a href="create-class.php"><i class="fa fa-bars"></i> <span>Create Class</span></a></li>
                        <li><a href="manage-class.php"><i class="fa fa fa-server"></i> <span>Manage Classes</span></a></li>

                    </ul>
                </li>
                <li class="has-children">
                    <a href="#"><i class="fa fa-book-open"></i> <span>Subjects</span> <i class="fa fa-angle-right arrow"></i></a>
                    <ul class="child-nav">
                        <li><a href="create-subject.php"><i class="fa fa-bars"></i> <span>Create Subject</span></a></li>
                        <li><a href="manage-subjects.php"><i class="fa fa fa-server"></i> <span>Manage Subjects</span></a></li>
                        <li><a href="add-subjectcombination.php"><i class="fa fa-newspaper-o"></i> <span>Add Subject Combination </span></a></li>
                        <a href="manage-subjectcombination.php"><i class="fa fa-newspaper-o"></i> <span>Manage Subject Combination </span></a>
                <!-- </li> -->
                </ul>
            </li>
            <li class="has-children">
                <a href="#"><i class="fa fa-users"></i> <span>Students</span> <i class="fa fa-angle-right arrow"></i></a>
                <ul class="child-nav">
                    <li><a href="add-students.php"><i class="fa fa-bars"></i> <span>Add Students</span></a></li>
                    <li><a href="manage-students.php"><i class="fa fa fa-server"></i> <span>Manage Students</span></a></li>

                </ul>
            </li>

            <li class="has-children">
                <a href="#"><i class="fa fa-landmark"></i> <span>Assignment</span> <i class="fa fa-angle-right arrow"></i></a>
                <ul class="child-nav">
                    <li><a href="manage-assignment.php"><i class="fa fa-bars"></i> <span>To-Do Assignment</span></a></li>
                    <li><a href="done-assignment.php"><i class="fa fa fa-check"></i> <span>Done Assignment</span></a></li>

                </ul>
            </li>


            
            <li class="nav-header">
                <span class="">Assignment Elections</span>
            </li>
            <li class="has-children">
                <a href="#"><i class="fa fa-crown"></i> <span>Condidate</span> <i class="fa fa-angle-right arrow"></i></a>
                <ul class="child-nav">
                        <li><a href="add-condidate.php"><i class="fa fa-bars"></i> <span>Add Condidate</span></a></li>
                        <li><a href="manage-condidates.php"><i class="fa fa fa-server"></i> <span>Manage Condidates</span></a></li>

                    </ul>
            </li>
            <li class="has-children">
                <a href="#"><i class="fa fa-vote-yea"></i> <span>Voters</span><i class="fa fa-angle-right arrow"></i> </a>
                <ul class="child-nav">
                        <li><a href="give-vote.php"><i class="fa fa-bars"></i> <span>Give Vote</span></a></li>
                        <li><a href="manage-votes.php"><i class="fa fa fa-server"></i> <span>Manage Votes</span></a></li>

                    </ul>
            </li>

            <li class="">
                <a href="manage-results.php"><i class="fa fa-info-circle"></i> <span>Results</span></a>
                <!-- <ul class="child-nav">
                    <li><a href="add-result.php"><i class="fa fa-bars"></i> <span>Add Result</span></a></li>
                    <li><a href=""><i class="fa fa fa-server"></i> <span>Manage Results</span></a></li>

                </ul> -->
            </li>

            <li class="has-children">
            <a href="#" data-toggle="modal"><i class="fa fa fa-users"></i> <span>Users</span><i class="fa fa-angle-right arrow"></i></a>
                <ul class="child-nav">
                    <li><a href="#user" data-toggle="modal"><i class="fa fa-user-plus"></i> <span>Add New User</span></a></li>
                    <li><a href="manage-users.php"><i class="fa fa fa-server"></i> <span>Manage Users</span></a></li>

                </ul>
            </li>
            <!-- The Following Modal Code is Placed in THe bottomfooter -->
            
                <!-- The Following Modal Code is Placed in THe bottomfooter -->
            <li><a href="#password" data-toggle="modal"><i class="fa fa fa-edit"></i> <span> Admin Change Password</span></a></li>

            

            </ul>
        </div>
        <!-- /.sidebar-nav -->
    </div>
    <!-- /.sidebar-content -->
</div>




        
