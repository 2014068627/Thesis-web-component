<?php
require_once(__DIR__."/../php_include/check_session.php");
require_once(__DIR__."/../php_include/db_connect.php");


$method = $_SERVER["REQUEST_METHOD"];

//switch case to get HTTP method
switch($method){
    case 'GET':
        if(isset($_GET[$id])){
            $id = $_GET['id'];
            $sql = "DELETE FROM user_table where id='$id'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            if(mysqli_query($connection, $sql)){
                /*
                $query = "SELECT DISTINCT ID, NAME, USERNAME FROM user_table WHERE id!=1";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $data = $result->fetch_assoc();
                echo json_encode($data);
                */
                echo "Success";

            }else{
                echo "Error " . mysqli_error($connection);
            }
        }else{
            header('Location: /adminweb/user_manage/?crud_user_update=GET_ERROR');
            exit();
        }
        
        break;
    case 'POST':
        if(isset($_POST['id']) and isset($_POST['name']) and isset($_POST['username']) and isset($_POST['password'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            //checks if those values are empty
            if($id != '' and $name != '' and $username != '' and $password != ''){
                $sql = "UPDATE user_table SET name='$name', username='$username', password='$password' WHERE id='$id'";
                if(mysqli_query($connection, $sql)){
                    echo "Added to DB";
                    header('Location: /adminweb/user_manage/?crud_user=updatedsuccessfully');
                    exit();
                }else{
                    echo "Error " . mysqli_error($connection);
                }
            }else{
                header('Location: /adminweb/user_manage/?crud_user_update=incomplete_form');
                exit();
            }
        }else{
            header('Location: /adminweb/user_manage/?crud_user_update=POST_ERROR');
            exit();
        }
        //echo 'Welcome to POST';
        break;
    default:
        break;
}