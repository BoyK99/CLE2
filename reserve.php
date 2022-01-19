<?php
    /** @var mysqli $db */

    $random = rand(0,8);

    //Check if submitted
    if (isset($_POST['submit'])) {
        //Database check
        require_once "includes/database.php";

        //Data from form
        $first_name     = mysqli_escape_string($db, $_POST['first_name']);
        $last_name      = mysqli_escape_string($db, $_POST['last_name']);
        $phone_number   = mysqli_escape_string($db, $_POST['phone_number']);
        $email          = mysqli_escape_string($db, $_POST['email']);
        $date           = mysqli_escape_string($db, $_POST['date']);
        $time           = mysqli_escape_string($db, $_POST['time']);
        $location       = mysqli_escape_string($db, $_POST['location']);
        $persons        = mysqli_escape_string($db, $_POST['persons']);
        $note           = mysqli_escape_string($db, $_POST['note']);
//        $table_id       = mysqli_escape_string($db, $_POST['table_Id']);

        //Form validation handling
        require_once "includes/form-validation.php";

        if (empty($errors)) {
            //Form data to the database
            $query = "INSERT INTO reservations (first_name, last_name, phone_number, email, date, time, location, persons, note, table_Id)
                      VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$date', '" . $time . "', '$location', '$persons', '$note', '$random')";
            $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

            if ($result) {
                header('Location: reserveOverview.php?id=');
                exit;
            } else {
                $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
            }

            //Close connection
            mysqli_close($db);
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>Afspraak inplannen</title>
    </head>
    <body class="bg-image">
        <?php include 'includes/header.php"';?>
            <div>
                <form action="" method="post">
                    <div class="reserve-form-outer">
                        <img class="reserve-form-logo" src="img/logo.png">
                        <div class="reserve-form-inner">
                            <div>
                                <label for="first_name">Naam: </label>
                                <input id="first_name" type="text" name="first_name">
                                <span class="errors"><?php echo $errors['first_name'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label>Achternaam: </label>
                                <input type="text" name="last_name">
                                <span class="errors"><?php echo $errors['last_name'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label>Telefoonnummer: </label>
                                <input id="phone_number" type="tel" name="phone_number">
                                <span class="errors"><?php echo $errors['phone_number'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="email">Email: </label>
                                <input id="email" type="text" name="email"">
                                <span class="errors"><?php echo $errors['email'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="date">Datum en tijd: </label>
                                <input id="date" type="date" name="date">
                                <input id="time" type="time" name="time">
                                <span class="errors"><?php echo $errors['date'] ?? ''; ?> <?php echo $errors['time'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="location">Restaurant locatie:</label>
                                <select id="location" name="location">
                                    <option value="">Kies een locatie</option>
                                    <option value="Voorstraat">Voorstraat</option>
                                    <option value="Amsterdamsestraatweg">Amsterdamsestraatweg</option>
                                </select>
                                <span class="errors"><?php echo $errors['location'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="persons">Aantal personen: </label>
                                <input id="persons" type="number" name="persons">
                                <span class="errors"><?php echo $errors['persons'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="note">Notitie: </label>
                                <textarea id="note" name="note" rows="3" cols="40"></textarea>
                            </div>
                            <br>
                            <div>
                                <button name="submit" type="submit" value="Reserveer" class="reserve">Reserveer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
         <?php include 'includes/footer.php"';?>
    </body>
</html>

