<?php
$errors = [];

if($update_first_name == ""){
    $errors['first_name'] = "Vul uw voornaam in";
}
if($update_last_name == ""){
    $errors['last_name'] = "Vul uw achternaam in";
}
if($update_email == ""){
    $errors['email'] = "Vul uw e-mailadres in";
}
if(strlen($update_phone_number) < 10 and strlen($update_phone_number) > 15){
    $errors['phone_number'] = "Uw telefoonnummer moet tussen 10 en 15 tekens lang zijn";
}
if($update_phone_number == ""){
    $errors['phone'] = "Vul uw telefoonnummer in";
}
if ($update_date == "") {
    $errors['date'] = "Selecteer een datum";
}
if ($update_time == "") {
    $errors['time'] =  "Selecteer een tijdstip";
}