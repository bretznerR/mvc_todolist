<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "tasks.php";

$tasks = new TaskModel();
$tasks->todoID = isset($_GET['id']) ? $_GET['id'] : die();

$data = $tasks->todoInfo();

echo json_encode($data);