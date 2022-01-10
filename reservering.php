<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Afspraak inplannen</title>
    </head>
    <body>
        <div>
            <form action="" method="post">
                <label>Naam: </label><input type="text" name="surName"> <label>Achternaam: </label><input type="text" name="lastName">
                <br>
                <label>Telefoonnummer: </label><input type="tel" name="phoneNumber">
                <br>
                <label>Adres: </label><input type="email" name="emailAdress">
                <br>
                <label>Datum en tijd: </label><input type="date" name="dateForm"> <input type="time" name="timeForm">
                <br>
                <label>Restaurant locatie:  </label><select name="Locatie">
                                                <option value="">Kies een locatie</option>
                                                <option value="Voorstraat">Voorstraat</option>
                                                <option value="Amsterdamsestraatweg">Amsterdamsestraatweg</option>
                                            </select>
                <br>
                <label>Aantal personen: </label><input type="number">
                <!-- Tafel (intern)-->
                <br>
                <label>Notitie: </label><input type="text">
                <br>
                <input value="Verzend" type="submit">
                <br>
                <br>
                <a href="login.php">Admin login</a>
            </form>
        </div>
    </body>
</html>