<?php
// Start the session to access session variables
session_start();

// Destroy all session data
session_unset(); // Unsets all session variables
session_destroy(); // Destroys the session

// Redirect the user to the login page after logging out
header("Location: ../views/view_staff_login.php");
exit;
?>
