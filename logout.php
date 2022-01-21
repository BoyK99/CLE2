<?php
    // Start session
    session_start();
    // End session
    session_destroy();
    // Redirect to login.php
    header('Location: login.php');
exit;
