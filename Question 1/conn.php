<?php 

    $servername = "localhost";
    $hostname = "root";
    $password = "";
    $database = "phpcrud";

    $conn = new mysqli($servername,$hostname,$password,$database);

    if($conn->connect_error)
        echo "Failed";

?>