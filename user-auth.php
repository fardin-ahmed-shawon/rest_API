<?php
header('Content-Type: application/json');
// Include database connection file
require_once 'db.php';
require_once 'config.php';
session_start();

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
//////////////////////////// Handle the 'user-login' action ///////////////////////////
////////////////////////////////////////////////////////////////////////////////////
if ($action == 'user-login') {

    // Get the username and password from POST data
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate the username and password
    if (empty($phone) || empty($password)) {
        $response = array(
            "success" => false,
            "message" => "You must provide both phone and password."
        );
        echo json_encode($response);
        exit();
    }

    // Prepare and execute the SQL query to check credentials
    $stmt = $con->prepare("SELECT * FROM users WHERE phone = ? AND password = ?");
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Set session variables for the user
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];

        $response = array(
            "success" => true,
            "message" => "Login Successful.",
            "user" => array(
                "id" => $user['id'],
                "user_full_name" => $user['first_name'] . ' ' . $user['last_name'],
                "user_phone" => $user['phone'],
                "user_role" => $user['role']
            )
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Invalid phone or password."
        );
    }

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