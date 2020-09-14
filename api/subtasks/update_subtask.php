<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require "subtasks.php";


$task = new SubTaskModel();

$data = json_decode(file_get_contents("php://input"));

$task->redirect($data);

$newDate = date_create($data->deadline);
date_format($newDate,"Y/m/d");

$task->id = $data->id;
$task->name = $data->task_name;
$task->priority = $data->priority;
$task->deadline = date_format($newDate,"Y/m/d");
$task->status = $data->status;

if($task->updateSubTask()){
   $message = "success";
   echo json_encode($message);
}else{
   $error = "error";
   echo json_encode($error);
}
