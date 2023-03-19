<?php

require_once 'Projects.php';

// Get start and count parameters from the AJAX request
$start = $_GET["start"];
$count = $_GET["count"];

// Create a new instance of the Projects class to interact with the database
$projects = new Projects();

// Retrieve the requested projects from the database
$projectData = $projects->getProjectBetween($start, $count);

// Convert the project data to a JSON-encoded string
$jsonData = json_encode($projectData);

// Set the content type header to application/json
header("Content-Type: application/json");

// Echo the JSON-encoded project data back to the client
echo $jsonData;
