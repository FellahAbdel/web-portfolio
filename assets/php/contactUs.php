<?php

require_once __DIR__ . "/../models/Contact.php";

$client = new Contact();
$userInputs = array($_POST["user-name"], $_POST["user-email"], $_POST["user-number"], $_POST["user-msg"]);

// var_dump($userInputs);
$client->storeClientInputs($userInputs);
