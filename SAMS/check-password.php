<?php
    session_start();
    require_once("includes/config.php");
    if(!empty($_POST['password'])){
        $password = md5($_POST['password']);
        $username = $_SESSION['slogin'];
         
    //     
        $sql = "SELECT student_rollno,password FROM students WHERE student_rollno=:roll AND  password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':roll', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    if($query->execute()){
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if ($query->rowCount() > 0) 
    echo "1";
    else 
    echo "Not Ok ";
    }else { print_r($query->errorInfo());
 
    }}
?>