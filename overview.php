<?php
    /** @var mysqli $db */
    session_start();

    //May I even visit this page?
    if (!isset($_SESSION['loggedInUser'])) {
        header("Location: login.php");
        exit;
    }
//    //Get email from session
//    $email = $_SESSION['loggedInUser']['email'];

    //Require DB settings with connection variable
    require_once "includes/database.php";

    //Get the result set from the database with a SQL query
    $query = "SELECT * FROM reservations";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    //Loop through the result to create a custom array
    $reservationLists = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reservationLists[] = $row;
    }

    //Close connection
    mysqli_close($db);
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Reserveringen - GYS</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <?php include 'includes/systemHeader.php';?>
        <h1>Reserveringen</h1>
        <table>
            <thead>
            <tr>
                <th>Naam</th>
                <th>Telefoonnummer</th>
                <th>Email</th>
                <th>Datum</th>
                <th>Tijdstip</th>
                <th>Locatie</th>
                <th>Personen</th>
                <th>Notitie</th>
                <th>Tafel</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservationLists as $reservationList) { ?>
                <tr>
                    <td><?= $reservationList['first_name'] . ' ' . $reservationList['last_name'] ?></td>
                    <td><?= $reservationList['phone_number'] ?></td>
                    <td><?= $reservationList['email'] ?></td>
                    <td><?= $reservationList['date'] ?></td>
                    <td><?= $reservationList['time'] ?></td>
                    <td><?= $reservationList['location'] ?></td>
                    <td><?= $reservationList['persons'] ?></td>
                    <td><?= $reservationList['note'] ?></td>
                    <td><?= $reservationList['table_id'] ?></td>
                    <td><a href="detailsReservation.php?id=<?= $reservationList['id']?>">Details</a></td>
                    <td><a href="editReservation.php?id=<?= $reservationList['id']?>">Edit</a></td>
                    <td><a href="deleteReservation.php?id=<?= $reservationList['id'] ?>">Verwijder</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </body>
</html>
