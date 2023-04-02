<?php

require_once __DIR__ . "/../models/Comment.php";

$comment = new Comment();
$userInputs = array($_GET["pseudo-name"], $_GET["user-msg"], $_GET["id"]);

$comment->storeClientInputs($userInputs);
