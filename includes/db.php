<?php
    // secure way to connect to database.

    // creating assosiative array to store values.

    $db['db_host'] = 'localhost';
    $db['db_user'] = 'root';
    $db['db_pass'] = '';
    $db['db_name'] = 'cms';

    // looping on array and making it constant

    foreach($db as $key => $value){
        // making each array elements constant.
        // strtoupper is used to convert string to uppercase.
        define(strtoupper($key), $value);
    }

    // making the connection by using constant vars.
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    
    // if($conn){
    //     echo 'we are connected';
    // }

?>