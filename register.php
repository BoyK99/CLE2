<?php
    // Check if submitted
    if(isset($_POST['submit'])) {
        // Require db connection file
        require_once "includes/database.php";

        // Database variable
        /** @var mysqli $db */

        // Variables for registering form
        $email = mysqli_escape_string($db, $_POST['user_name']);
        $password = $_POST['password'];
        $time_stamp = date("Y-m-d H:i:s");

        // Check if empty
        $errors = [];
        if($email == '') {
            $errors['user_name'] = 'Voer een gebruikersnaam in';
        }
        if($password == '') {
            $errors['password'] = 'Voer een wachtwoord in';
        }

        // Insert in db
        if(empty($errors)) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (user_name, password, create_date) VALUES ('$email', '$password', '$time_stamp')";

            $result = mysqli_query($db, $query)
            or die('Db Error: '.mysqli_error($db).' with query: '.$query);

            if ($result) {
                header('Location: login.php');
                exit;
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css"/>
    <title>Registreren</title>
</head>
<body>
<h2>Nieuwe gebruiker registeren</h2>
<form action="" method="post">
    <div class="data-field">
        <label for="user_name">Email</label>
        <input id="user_name" type="text" name="user_name" value="<?= $email ?? '' ?>"/>
        <span class="errors error"><?= $errors['user_name'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="password">Wachtwoord</label>
        <input id="password" type="password" name="password" value="<?= $password ?? '' ?>"/>
        <span class="errors error"><?= $errors['password'] ?? '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Registreren"/>
    </div>
</form>

</body>
</html>
