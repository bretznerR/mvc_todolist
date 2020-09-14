<?php
header("Access-Control-Allow-Origin: *");


require "subtasks.php";
$tasks = new SubTaskModel();
$tasks->taskID = isset($_GET['id']) ? $_GET['id'] : die();

$data = $tasks->getSubTasksById();
echo json_encode($data);