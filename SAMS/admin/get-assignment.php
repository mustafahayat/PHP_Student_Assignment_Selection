<?php
require_once("includes/config.php");
if (!empty($_POST['id'])) {
    $assignment_id = $_POST['id'];
    $rows = $dbh->query("SELECT *FROM condidates WHERE assignment_id = '$assignment_id'");
    $rowCount =  $rows->rowCount();
    if ($rowCount > 0) {
        echo 1;
    }
    // echo $student_id;
    $sql = "SELECT *, (SELECT fullname FROM students
    WHERE student_rollno = main.student_rollno)as fullname FROM done_assignments as main WHERE assignment_id = :roll";
    $query = $dbh->prepare($sql);
    $query->bindParam(':roll', $assignment_id, PDO::PARAM_STR);
    $query->execute();


    $result = $query->fetchAll(PDO::FETCH_OBJ);

?>


    <div class="form-group">
        <label for="name" class=" control-label">Student Fullname</label>
        <div class="">

            <select name="student_id" class="form-control" id="student" required="required">
                <option value="">Select Student Name</option>
                <?php foreach ($result as $row) { ?>
                    <option value="<?php echo $row->student_rollno ?>"><?php echo $row->fullname; ?> </option>
                <?php
                } ?>
            </select>
        </div>
    </div>





    <div class="form-group">
        <label for="default" class="control-label">Election Round</label>
        <div class="">
            <select name="election_round" class="form-control" id="default" required>
                <option value="">Select Election Round</option>
                <option value="1">First</option>
                <option value="2">Second</option>
                <option value="3">Third</option>
            </select>

        </div>
    </div>

    <div class="form-group">
        <label for="default" class="control-label">Expire Date</label>
        <input type="date" name="date" id="date" class="form-control">
    </div>

<?php  //====================================================
} // end of the else blcok
?>

<?php
    // Get the Assignment and More info of the Specified Condidates:
        
    if(!empty($_POST['condidate_id'])){
        $condidate = $_POST['condidate_id'];
        $sql = "SELECT condidates.*, students.fullname, assigned_assignments.assignment_name, 
         assigned_assignments.lecturer, done_assignments.done_assignment_file FROM condidates 
        INNER JOIN students ON condidates.condidate_id = students.student_rollno 
        INNER JOIN assigned_assignments ON condidates.assignment_id = assigned_assignments.assignment_id 
        INNER JOIN done_assignments ON condidates.assignment_id = done_assignments.assignment_id
        WHERE condidate_id = :condidate";
    $query = $dbh->prepare($sql);
    $query->bindParam(':condidate', $condidate, PDO::PARAM_STR);
    $query->execute();


    $result = $query->fetch(PDO::FETCH_ASSOC);
    
?>

<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Assignment File Of <?php echo $result['fullname']; ?></h4><br>
            
                <span><strong><?php echo $result['lecturer'] ?>, </strong>
                <small>Lecturer The Subject</small></span>

                <span class="pull-right"><strong><?php echo $result['assignment_name'] ?>, </strong>
                <small>Name Of The Assignment</small></span>
            </div>
            <div class="modal-body">
                
                

    <!-- <object type="application/pdf" width="100%" height="100%" data="assignments/The_Use_of_Remote_Access_Tools_by_System_Administr.pdf"></object> -->
                <iframe src="../<?php echo $result['done_assignment_file']; ?>" frameborder="0" width="100%"></iframe>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>



<?php
    } 