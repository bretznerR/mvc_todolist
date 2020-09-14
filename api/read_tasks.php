<?php
header("Access-Control-Allow-Origin: *");


require "tasks.php";
$tasks = new TaskModel();
$tasks->todoID = isset($_GET['id']) ? $_GET['id'] : die();

$data = $tasks->getTasksById();
echo json_encode($data);