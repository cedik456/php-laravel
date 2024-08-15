<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn) {
        echo("You are connected");
    }
    else{
        echo "Could not connect";
    }

    $conn->close();

?>