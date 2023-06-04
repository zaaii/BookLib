<?php
    session_start();
    require("model.php");
// Check if the session ID is set in the session
    if (isset($_SESSION['session_id'])) {
        // Call the logoutSession() function to update the logout time
        $sessionId = $_SESSION['session_id'];
        logoutSession($sessionId);
    }
    
    // Destroy the session and unset the session variables
    session_destroy();
    unset($_SESSION['id_user']);
    unset($_SESSION['session_id']);
    
    // Redirect to the login page or any other desired page
    header("Location: login.php");
    exit;
    ?>