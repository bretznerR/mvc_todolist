<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "tasks.php";

$task = new TaskModel();

$task->id = isset($_GET['id']) ? $_GET['id'] : die();
//echo $task->id;
$data = $task->readOneTask();

$data_arr = [["id"=>$task->id,
	         "name"=>$task->name,
	         "priority"=>$task->priority,
	         "deadline"=>$task->deadline,
	         "status"=>$task->status],
             [["id"=>"low"], ["id"=>"normal"], ["id"=>"high"]],
	         [["id"=>"completed"], ["id"=>"no completed"]]
            ];

echo json_encode($data_arr);