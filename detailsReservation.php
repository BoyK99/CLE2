<?php
    /** @var mysqli $db */

    // redirect when uri does not contain a id
    if(!isset($_GET['id']) || $_GET['id'] == '') {
        // redirect to index.php
        header('Location: overview.php');
        exit;
    }

    //Require database in this file
    require_once "includes/database.php";

    //Retrieve the GET parameter from the 'Super global'
    $reservationId = mysqli_escape_string($db, $_GET['id']);

    //Get the record from the database result
    $query = "SELECT * FROM reservations WHERE id = '$reservationId'";
    $result = mysqli_query($db, $query)
    or die ('Error: ' . $query );

    if(mysqli_num_rows($result) != 1)
    {
        // redirect when db returns no result
        header('Location: index.php');
        exit;
    }

    $reservationView = mysqli_fetch_assoc($result);

    //Close connection
    mysqli_close($db);
?>
<html lang="en">
    <head>
        <title><?= $reservationView['first_name'] . ' ' . $reservationView['last_name'] . ' - ' . $reservationView['date'] ?></title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <?php include 'includes/systemHeader.php';?>
        <h1><?= $reservationView['first_name']. ' ' .$reservationView['last_name']  . ' - ' . $reservationView['date'] . ' om ' . $reservationView['time']  ?></h1>
        <ul>
            <li>Telefoonnummer:  <?= $reservationView['phone_number'] ?></li>
            <li>Email:   <?= $reservationView['email'] ?></li>
            <li>Locatie: <?= $reservationView['location'] ?></li>
            <li>Notitie: <?= $reservationView['note'] ?></li>
        </ul>
        <div>
            <a href="overview.php">Ga terug naar overzicht</a>
        </div>
    </body>
</html>
