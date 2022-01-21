<?php
    // Start session
    session_start();

    // Check if already logged in
    if(isset($_SESSION['loggedInUser'])) {
        $login = true;
        header('Location: overview.php');
    } else {
        $login = false;
    }

    // Database variable
    /** @var mysqli $db */

    // Require database in this file
    require_once "includes/database.php";

    // Check if form submit has been clicked
    if (isset($_POST['submit'])) {
        // Check username and password
        $usernameInput = mysqli_escape_string($db, $_POST['usernameInput']);
        $password = $_POST['passwordInput'];

        // Check if empty
        $errors = [];
        if($usernameInput == '') {
            $errors['usernameInput'] = 'Voer een gebruikersnaam in';
        }
        if($password == '') {
            $errors['passwordInput'] = 'Voer een wachtwoord in';
        }

        if(empty($errors)) {
            // Get record from db based on first name
            $query = "SELECT * FROM users WHERE user_name='$usernameInput'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    $login = true;

                    // Create session
                    $_SESSION['loggedInUser'] = [
                        'usernameInput' => $user['user_name'],
                        'id' => $user['id']
                    ];
                    header('Location: overview.php');
                } else {
                    // Error wrong login data
                    $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bij ons niet bekend';
                }
            } else {
                // Error wrong login data
                $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bij ons niet bekend';
            }
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
        <title>Login - GYS</title>
    </head>
    <body class="bg-image">
        <?php include 'includes/header.php"';?>
            <div class="login-form-outer">
                <?php if ($login) { ?>

                <?php } else { ?>
                    <form action="" method="post">
                        <div class="login-form-middle">
                            <img class="login-image" src="img/logo.png">
                            <h2>Login</h2>
                            <div class="login-form-inner">
                                <div>
                                    <input placeholder="Gebruikersnaam" type="text" name="usernameInput" value="<?= $usernameInput ?? '' ?>">
                                    <span class="errors"><?= $errors['usernameInput'] ?? '' ?></span>
                                </div>
                                <div>
                                    <input placeholder="Wachtwoord" type="text" name="passwordInput">
                                    <span class="errors"><?= $errors['passwordInput'] ?? '' ?></span>
                                </div>
                                <div>
                                    <p class="errors"><?= $errors['loginFailed'] ?? '' ?></p>
                                    <input type="submit" name="submit" value="Login"/>
                                </div>
<!--                                <button onclick="window.history.go(-1); return false;">Terug</button>-->
                                <br>
                                <a href="passwordReset.php">Wachtwoord vergeten?</a>
                                <br>
                                <a href="usernameReset.php">Gebruikersnaam vergeten?</a>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        <?php include 'includes/footer.php"';?>
    </body>
</html>