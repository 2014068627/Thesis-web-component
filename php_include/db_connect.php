<?php
    //get connection
    $connection = mysqli_connect('localhost', 'root', '', 'powerboard');
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }

