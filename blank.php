<?php
header('Content-Type: application/json');
// Include database connection file
require_once 'db.php';
require_once 'config.php';


// Set a custom error handler to return JSON for errors
set_exception_handler(function ($exception) {
    $response = array(
        "success" => false,
        "message" => $exception->getMessage()
    );
    echo json_encode($response);
    exit();
});


// Receive the action type
$action = $_GET['action'] ?? '';

// Check if the 'action' parameter is set in the URL
if ($action == '') {
    $response = array(
        "success" => false,
        "message" => "No action specified."
    );
    echo json_encode($response);
    exit();
}


//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Handle the 'action_name' action ///////////////////////////
////////////////////////////////////////////////////////////////////////////////////
if ($action == 'action_name') {

    $response = array(
        "success" => true,
        "message" => "Action Successfully Excuted"
    );

    echo json_encode($response);
    exit();
}
////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// END ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////


// Handle wrong/invalid action
else {
    $response = array(
        "success" => false,
        "message" => "Invalid action specified."
    );
    echo json_encode($response);
    exit();
}

?>