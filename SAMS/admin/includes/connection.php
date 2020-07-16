<?php
    $server = "localhost";
    $username = "root";
    $password = "";

    define("SALT", "ZAHIN@123");
    $connect = new mysqli($server, $username, $password);
    if($connect->connect_error)
        print "Error in Connection : ". $connect->connect_error;
    // else
    //     print "Connection Successfull!";
       
        // Selection of the database

        $sql = "use vote";
        $connect->query($sql);


        // if($connect->query($sql))
        //     // print "Ok";
        // else
        //     print "Field";

    //     // To validate user input
    // function test_input($data) {
    //         $data = trim($data);
    //         $data = stripslashes($data);
    //         $data = htmlspecialchars($data);
    //         return $data;
    //       }

        //   to make it as true input (remove the the special char)
    function getValue($data){
       // to validate the data
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        // to make an input like real sql script
        // mean remove the harmfull chars
        global $connect;// make it global
        $result = $connect->real_escape_string($data);
        return $result;
    }

    // use for adding SALT to the password.
    function encrypt($password){
        return SALT. $password;
    }
    
          
    
?>