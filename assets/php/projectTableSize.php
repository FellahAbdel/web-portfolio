<?php

require_once __DIR__ . "/../models/Projects.php";
$project = new Projects();

echo json_encode($project->getProjectTableSize());
