<?php
require_once(__DIR__."/../php_include/check_session.php");
require_once(__DIR__."/../php_include/db_connect.php");


$method = $_SERVER["REQUEST_METHOD"];

//switch case to get HTTP method
switch($method){
    case 'GET':
        //get id from ajax call
        $id = $_GET['id'];
        $query = "SELECT * FROM user_table where id='$id'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $data = $result->fetch_assoc();
        echo json_encode($data);
        break;
    case 'POST':
        if(isset($_POST['name']) and isset($_POST['username']) and isset($_POST['password'])){
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($password != $cpassword){
                //do go back
               // echo "You do not passed in POST";
            }else{
                //continue
                //echo "You passed in POST";
                //add user in database
                $sql = "INSERT INTO user_table (name, username, password) VALUES ('$name', '$username', '$password')";
                if(mysqli_query($connection, $sql)){
                    echo "Added to DB";
                    header('Location: /adminweb/user_manage/?crud_user=addedsuccessfully');
                    exit();
                }else{
                    echo "Error " . mysqli_error($connection);
                }
                
            }
        }else{
            header('Location: /adminweb/user_manage/?crud_user=POST_ERROR');
            exit();
        }

        break;
    default:
        break;
}