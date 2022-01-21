<?php
    // Start session
    session_start();

    // Can I even visit this page?
    if (!isset($_SESSION['loggedInUser'])) {
        header("Location: login.php");
        exit;
    }

    // Database variable
    /** @var mysqli $db */

    // Database connection
    require_once("includes/database.php");

    // Check for id
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']);

    // Check if id is right
    if(isset($_GET['id'])){
        $query = mysqli_query($db, "SELECT * FROM reservations WHERE id = '$id'");
        while($row = mysqli_fetch_assoc($query)){
            $first_name =       $row['first_name'];
            $last_name =        $row['last_name'];
            $phone_number =     $row['phone_number'];
            $email =            $row['email'];
            $date =             $row['date'];
            $time =             $row['time'];
            $location =         $row['location'];
            $persons =          $row['persons'];
            $note =             $row['note'];
        }
    } else {
        echo "het werkt niet";
    }

    // Check if update button is clicked
    if(isset($_POST['update'])){
        $update_first_name =    $_POST['first_name'];
        $update_last_name =     $_POST['last_name'];
        $update_phone_number =  $_POST['phone_number'];
        $update_email =         $_POST['email'];
        $update_date =          $_POST['date'];
        $update_time =          $_POST['time'];
        $update_location =      $_POST['location'];
        $update_persons =       $_POST['persons'];
        $update_note =          $_POST['note'];

        // Form validator starts
        require_once("includes/update_reservation_validation.php");

        // Prepare SQL
        if(empty($errors)){
            $update_query = "UPDATE reservations SET first_name='$update_first_name', last_name='$update_last_name', 
                        phone_number='$update_phone_number', email='$update_email', date='$update_date', time='$update_time', 
                        location='$update_location', persons='$update_persons', note='$update_note' WHERE id='$id'";
            $result = mysqli_query($db, $update_query);
            // If succes redirect to overview.php
            if($result){
                header('Location: overview.php');
                exit;
            } else{
                $errors['db'] = "Er is een fout opgetreden...";
            }
        }
        // Close connection to db
        mysqli_close($db);
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Afspraak inplannen</title>
    </head>
    <body>
    <?php include 'includes/systemHeader.php';?>
            <div>
                <form action="" method="post">
                    <div class="reserve-form-outer">
                        <img class="reserve-form-logo" src="img/logo.png">
                        <div class="reserve-form-inner">
                            <div>
                                <label for="first_name">Naam: </label>
                                <input id="first_name" type="text" name="first_name" value="<?php if(isset($update_first_name)){ echo $update_first_name; } else{ echo $first_name; } ?>">
                                <span class="errors"><?php echo $errors['first_name'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label>Achternaam: </label>
                                <input type="text" name="last_name" value="<?php if(isset($update_last_name)){ echo $update_last_name; } else{ echo $last_name; } ?>">
                                <span class="errors"><?php echo $errors['last_name'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label>Telefoonnummer: </label>
                                <input id="phone_number" type="tel" name="phone_number" value="<?php if(isset($update_phone_number)){ echo $update_phone_number; } else{ echo $phone_number; } ?>">
                                <span class="errors"><?php echo $errors['phone_number'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="email">Email: </label>
                                <input id="email" type="text" name="email" value="<?php if(isset($update_email)){ echo $update_email; } else{ echo $email; } ?>">
                                <span class="errors"><?php echo $errors['email'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="date">Datum en tijd: </label>
                                <input id="date" type="date" name="date" value="<?php if(isset($update_date)){ echo $update_date; } else{ echo $date; } ?>">
                                <input id="time" type="time" name="time" value="<?php if(isset($update_time)){ echo $update_time; } else{ echo $time; } ?>">
                                <span class="errors"><?php echo $errors['date'] ?? ''; ?> <?php echo $errors['time'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="location">Restaurant locatie:</label>
                                <select id="location" name="location" >
                                    <option value="<?php if(isset($update_location)){ echo $update_location; } else{ echo $location; } ?>"></option>
                                    <option value="">Kies een locatie</option>
                                    <option value="Voorstraat">Voorstraat</option>
                                    <option value="Amsterdamsestraatweg">Amsterdamsestraatweg</option>
                                </select>
                                <span class="errors"><?php echo $errors['location'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="persons">Aantal personen: </label>
                                <input id="persons" type="number" name="persons" value="<?php if(isset($update_persons)){ echo $update_persons; } else{ echo $persons; } ?>">
                                <span class="errors"><?php echo $errors['persons'] ?? ''; ?></span>
                            </div>
                            <br>
                            <div>
                                <label for="note">Notitie: </label>
                                <textarea id="note" name="note" rows="3" cols="40" ><?php if(isset($update_note)){ echo $update_note; } else{ echo $note; } ?></textarea>
                            </div>
                            <br>
                            <div>
                                <button name="update" type="submit" class="reserve">Wijzig reservering</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php include 'includes/footer.php"';?>
    </body>
</html>
