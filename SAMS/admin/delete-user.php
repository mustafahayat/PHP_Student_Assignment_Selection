<?php
    if(!empty($_GET['id']))
    require_once("includes/config.php");
    $id = intval($_GET['id']);
    $statment = $dbh->prepare("DELETE FROM users WHERE user_id = :user");
    $statment->bindParam(':user', $id, PDO::PARAM_INT);

    if($statment->execute()){
        $msg = "User Deleted Successfully!";
    }else{
        $msg = "Something went wrong. Please try again!";
    }
    header("location: manage-users.php?msg=". $msg);

?>