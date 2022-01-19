<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($first_name == "") {
    $errors['first_name'] = 'Voornaam kan niet leeg zijn.';
}
if ($last_name == "") {
    $errors['last_name'] = 'Achternaam kan niet leeg zijn.';
}
if (strlen($phone_number) < 10 and strlen($phone_number) > 15) {
    $errors['phone_number'] = 'Uw telefoonnummer moet tussen 10 en 15 tekens lang zijn.';
}
if ($phone_number == "") {
    $errors['phone_number'] = 'Vul uw telefoonnummer in';
}
if ($email == "") {
    $errors['email'] = 'Vul uw e-mailadres in';
}
if ($date == "") {
    $errors['date'] = 'Selecteer een datum';
}
if ($time == "") {
    $errors['time'] = 'Selecteer een tijdstip';
}
if ($location == "") {
    $errors['location'] = 'Selecteer een locatie';
}
if ($persons == "") {
    $errors['persons'] = 'Geef aantal personen aan';
}
