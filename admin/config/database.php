<?php
    require 'constants.php';
    $connection = new mysqli(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME);
    if(mysqli_errno($connection)){
        echo "Connection failse!!!";
        die(mysqli_error($connection));
    
    }
  ?>