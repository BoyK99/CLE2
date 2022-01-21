<?php
    // Variables for connection
    $host       = "localhost";
    $database   = "gys";
    $user       = "root";
    $password   = "";

    // Make connection
    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());;
