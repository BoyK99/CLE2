<?php
    session_start();

    //May I even visit this page?
    if (!isset($_SESSION['loggedInUser'])) {
        header("Location: login.php");
        exit;
    }
//
//
//    //Get email from session
//    $email = $_SESSION['loggedInUser']['email'];
?>

<?php include 'includes/systemHeader.php"';?>
