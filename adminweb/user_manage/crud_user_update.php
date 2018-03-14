<?php
require_once(__DIR__."/../php_include/check_session.php");
require_once(__DIR__."/../php_include/db_connect.php");


$method = $_SERVER["REQUEST_METHOD"];

//switch case to get HTTP method
switch($method){
    case 'GET':
        echo 'This is get';
        break;
    case 'POST':
        /**
         * Update User information
         */
        if(isset($_POST['id']) and isset($_POST['name']) and isset($_POST['username'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];

            /**
             * valide username
             */
            $query_username = "SELECT DISTINCT USERNAME FROM user_table WHERE id!=$id and username='$username'";
            $result_username = mysqli_query($connection, $query_username) or die(mysqli_error($connection));
            $count_username = mysqli_num_rows($result_username);
            if($count_username >= 1){
                //if user has duplicate username
                header('Location: /adminweb/user_manage/?edit_user=ERROR');
                exit(); 
            }else{
                //if user has unique username
                $sql = "UPDATE user_table SET username='$username', name='$name' WHERE id=$id";
                if(mysqli_query($connection, $sql)){
                    header('Location: /adminweb/user_manage/?edit_user=successful');
                    exit();
                }else{ 
                    echo "Error " . mysqli_error($connection);
                }

            }

        }else{

        }
        break;
    case 'DELETE':
        /**
         * Delete user using AJAX from .deleteBttn
         */
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "DELETE FROM user_table where id='$id'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            if(mysqli_query($connection, $sql)){
                echo 'ID '.$id.' is deleted';
            }else{
                echo "Error " . mysqli_error($connection);
            }
            
        }else{
            //do something
            echo 'Nothing to say';
        }

    default:
        break;
}