<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "subtasks.php";

$tasks = new SubTaskModel();
$tasks->taskID = isset($_GET['id']) ? $_GET['id'] : die();

$data = $tasks->subtasktodoInfo();



echo json_encode($data);