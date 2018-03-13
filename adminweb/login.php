<?php
    session_start();

    //get required file
    require_once(__DIR__."/php_include/db_connect.php");

    //checks if value is set on POST
    if(isset($_POST['username']) and isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT DISTINCT USERNAME, PASSWORD FROM user_table where id=1 AND username='$username' AND password='$password'";
        
        //gets result from query getting the first id and username and password
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        //checks count for user
        $count = mysqli_num_rows($result);
        if($count == 1){
            $_SESSION['admin'] = $username;
            header("Location: /adminweb/user_manage");
            exit();
        }else{
            //redirect to index
            header("Location: /adminweb/?auth=false");
            exit();
        }
        echo 'Hello ' . $count; 
    }else{
        header("Location: /adminweb/?auth=false");
        exit();
    }
