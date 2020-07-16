<?php
session_start();
    require_once("includes/config.php");
    $assignment_id = $_POST['id'];
     


    $rollno = $_SESSION['slogin'];
    $sql = "SELECT student_rollno FROM voters WHERE student_rollno = :roll AND assignment_id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':roll', $rollno, PDO::PARAM_STR);
    $query->bindParam(':id', $assignment_id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
       echo "<script>bootbox.alert({
           size : 'large',
           title : 'Alert',
           message :'You Have Already Selected A Condidate!!'
        })</script>
        <h2 class='p-5 border text-center alert alert-danger'>You Have Already Selected A Condidate!!</h2>";
    }else{ 

    $sql = "SELECT condidates.*, students.fullname, students.photo, assigned_assignments.assignment_name, assigned_assignments.assignment_file, assigned_assignments.lecturer 
    FROM condidates INNER JOIN students ON condidates.condidate_id = students.student_rollno INNER JOIN assigned_assignments ON condidates.assignment_id = assigned_assignments.assignment_id 
    WHERE DATEDIFF(expire_date, curdate()) >= 0 AND condidates.assignment_id= :roll; ";
     
 $query = $dbh->prepare($sql);
 $query->bindParam(':roll', $assignment_id, PDO::PARAM_STR);
 $query->execute();


 $result = $query->fetchAll(PDO::FETCH_OBJ);

    
  
?>
   

<ul style="list-style-type: none">
<?php foreach ($result as $row) {  
    $photo = ltrim($row->photo, " ../ "); ?>
    <li class="well-sm">
    <a data-toggle="modal" data-id="<?php echo $row->condidate_id; ?>" title="Add this item" class="open-AddBookDialog btn btn-primary fa fa-search" href="#myModal">View Assignment</a>
        <img src="<?php echo $photo; ?>" alt="codidate" width="80px" height="80px" class="img-circle">
        <span style="font-size: 23px"><?php echo $row->fullname; ?></span>
        <span class="badge bg-success badge-lg well pull-right">
            <span class="fa fa-hand-point-right text-danger" style="font-size: 20px"></span>
            <input type="checkbox" name="condidate_id[]" value="<?php echo $row->condidate_id ?>">
        </span>
    </li>
<?php } ?>

</ul>

    <?php } ?>
                                <!--  -->