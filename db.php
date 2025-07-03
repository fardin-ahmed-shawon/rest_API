<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "rest_api";

// Create connection
$con = new mysqli($hostname, $username, $password, $database_name);

// Check connection
if ($con->connect_errno) {

    $response = array(
        "error" => true,
        "message" => "Database Connection Error"
    );

    echo json_encode($response);
    die();
}

?>