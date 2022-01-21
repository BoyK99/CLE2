<?php
    // Start session from previous page
    session_start();
?>
<html lang="en">
    <head>
        <title>Reservering gelukt - GYS</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <?php include 'includes/systemHeader.php';?>
        <h1> Overzicht reserving</h1>
        <ul>
            <li>Naam:           <?= $_SESSION['form-data']['first_name']. ' ' .$_SESSION['form-data']['last_name'] ?></li>
            <li>Datum:          <?= $_SESSION['form-data']['date'] ?></li>
            <li>Tijdstip:       <?= $_SESSION['form-data']['time'] ?></li>
            <li>Locatie:        <?= $_SESSION['form-data']['location'] ?></li>
            <li>Notitie:        <?= $_SESSION['form-data']['note'] ?></li>
        </ul>
        Uw reserving is gelukt
        <?php include 'includes/footer.php"';?>
    </body>
</html>