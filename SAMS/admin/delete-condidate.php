<?php 

    require_once("includes/config.php");
    if(isset($_GET['condidate'])  && isset($_GET['assignment']) &&   isset($_GET['election'])){
        $condidate_id = intval($_GET['condidate']);
        $assignment_id = intval($_GET['assignment']);
        $election_round = intval($_GET['election']);

        
        $sql1 = "DELETE FROM condidates
        WHERE condidate_id = :condidate_id AND assignment_id = :assignment_id AND election_round = :election_round";
        $statment = $dbh->prepare($sql1);

        $statment->bindParam(':condidate_id', $condidate_id, PDO::PARAM_INT);
        $statment->bindParam(':assignment_id', $assignment_id, PDO::PARAM_INT);
        $statment->bindParam(':election_round', $election_round, PDO::PARAM_INT);

        if($statment->execute()){
            $msg = "Record Deleted Successfully!";
        }else{
            $msg = "Something went wrong. Please try again!";
        }
        header("location: manage-condidates.php?msg=". $msg);

    }

?>