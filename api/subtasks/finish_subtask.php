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

$task->id = $data->id;

if($task->finishsubTask()){
    $message = "success";
    echo json_encode($message);
}else{
   $error = "error";
   echo json_encode($error);
}