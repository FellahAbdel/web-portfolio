<?php

require_once __DIR__ . '/../models/Projects.php';

$projects = new Projects();
echo "<pre>";
$rows = $projects->getProjects();
var_dump($rows);
echo "</pre>";
