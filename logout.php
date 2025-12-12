<?php
require_once 'config.php';

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page with success message
header("Location: login.php?message=logged_out");
exit();
?>