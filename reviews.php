<?php
    // Start session
    session_start();

    // Can I even visit this page?
    if (!isset($_SESSION['loggedInUser'])) {
        header("Location: login.php");
        exit;
    }
?>

<?php include 'includes/systemHeader.php"';?>
<html>
    WIP
</html>



