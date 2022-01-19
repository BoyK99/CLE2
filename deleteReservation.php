<?php
    /** @var mysqli $db */

    //Require music data & image helpers to use variable in this file
    require_once "includes/database.php";

    if (isset($_POST['submit'])) {
        // DELETE IMAGE
        // To remove the image we need to query the file name from the db.
        // Get the record from the database result
        $id = mysqli_escape_string($db, $_POST['id']);
        $query = "SELECT * FROM reservations WHERE id = '$id'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query);

        $reservationView = mysqli_fetch_assoc($result);

        // DELETE DATA
        // Remove the album data from the database with the existing albumId
        $query = "DELETE FROM reservations WHERE id = '$id'";
        mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

        //Close connection
        mysqli_close($db);

        //Redirect to homepage after deletion & exit script
        header("Location: overview.php");
        exit;

    } else if (isset($_GET['id']) || $_GET['id'] != '') {
        //Retrieve the GET parameter from the 'Super global'
        $id = mysqli_escape_string($db, $_GET['id']);

        //Get the record from the database result
        $query = "SELECT * FROM reservations WHERE id = '$id'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query);

        if (mysqli_num_rows($result) == 1) {
            $reservationView = mysqli_fetch_assoc($result);
        } else {
            // redirect when db returns no result
            header('Location: overview.php');
            exit;
        }
    } else {
        // Id was not present in the url OR the form was not submitted

        // redirect to index.php
        header('Location: overview.php');
        exit;
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Delete Afspraak</title>
    </head>
    <body>
    <?php include 'includes/systemHeader.php';?>
    <h2>Delete - <?= $reservationView['first_name'] . ' ' . $reservationView['last_name'] . ' - ' . $reservationView['date']?></h2>
    <form action="" method="post">
        <p>
            Weet u zeker dat je deze reservering van "<?= $reservationView['first_name'] . ' ' . $reservationView['last_name'] . ' - ' . $reservationView['date']?>" wilt verwijderen?
        </p>
        <input type="hidden" name="id" value="<?= $reservationView['id'] ?>"/>
        <input type="submit" name="submit" value="Verwijderen"/>
    </form>
    </body>
</html>
