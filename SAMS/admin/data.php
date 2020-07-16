<?php
header('Content-Type: application/json');
if(!empty($_POST['assignment_id'])) {
//    echo $_POST['assignment_id'];
require_once("includes/config.php");
 
$id = $_POST['assignment_id'];
    $sqlQuery = "SELECT main.total_votes, main.condidate_id, 
(SELECT fullname FROM students WHERE student_rollno = main.condidate_id)AS condidate_name FROM condidates 
AS main WHERE assignment_id = :id";

   

   
    $query = $dbh->prepare($sqlQuery);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
 
    echo json_encode($data);

}
?>