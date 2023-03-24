<?php

    // constant
    define("HOSTNAME", "localhost:4000");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "clean_blog");

    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if(!$connection){
        die('Connection Failed');
    }

?>