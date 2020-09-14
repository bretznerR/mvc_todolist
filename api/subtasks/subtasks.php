<?php

require_once "../../config.php";
require_once  "../../classes/Model.php";
require_once  "../../classes/Helper.php";

class SubTaskModel extends Model{


    public $id;
    public $name;
    public $priority;
    public $deadline;
    public $status;
    public $taskID;
    public $where;
    public $order;

    public function redirect($var)
    {
        if (!isset($var)) {
            header("Location: " . ROOT_PATH . "users/login");
        }
    }

    public function getSubTasksById()
    {
        try{
            $this->query("SELECT subtask.id as subtaskid, subtask.priority, subtask.deadline, subtask.status, 
		    subtask.name, DATEDIFF(subtask.deadline, CURDATE()) as datediff FROM subtask left OUTER JOIN task 
		    ON subtask.taskID=task.id WHERE task.id=:id");
            $this->bind(":id", $this->taskID);
            $rows = $this->resultSet();
            return $rows;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return;
        }

        if (!isset($rows)) {
            echo json_encode('[{}]');
        }

    }

    public function createSubTask()
    {
        try{
            $this->query("INSERT INTO subtask (subtask.name, subtask.priority, subtask.deadline, taskID)
		                  VALUES (:name, :priority, :deadline, :task)");
            $this->bind(":name", $this->name);
            $this->bind(":priority", $this->priority);
            $this->bind(":deadline", $this->deadline);
            $this->bind(":task", $this->taskID);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }


    }

    public function updateSubTask()
    {
        try{
            $this->query("UPDATE subtask SET name=:name,
				                          priority=:priority,
				                          deadline=:deadline,
				                          status=:status
				          WHERE id=:id");
            $this->bind(":name", $this->name);
            $this->bind(":priority", $this->priority);
            $this->bind(":deadline", $this->deadline);
            $this->bind(":status", $this->status);
            $this->bind(":id", $this->id);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }

    }

    public function deleteSubTasK()
    {
        try{
            $this->query("DELETE FROM subtask WHERE id=:id");
            $this->bind(":id", $this->id);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }

    }

    public function readOneSubTask()
    {
        try{
            $this->query("SELECT * FROM subtask WHERE id =" . $this->id);
            $row = $this->single();
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return;
        }
        if ($row) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->priority = $row['priority'];
            $this->deadline = $row['deadline'];
            $this->status = $row['status'];
            $this->taskID = $row['taskID'];
        }

    }

    public function finishsubTask()
    {
        try{
            $this->query("UPDATE subtask SET status='completed' WHERE id=:id");
            $this->bind(":id", $this->id);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }
    }

    public function subtasktodoInfo()
    {
        try{
            $this->query("SELECT todoapp.subtask.status, COUNT(*) as total, (SELECT COUNT(*) FROM todoapp.subtask WHERE todoapp.subtask.status='no completed' AND todoapp.subtask.taskID=:id) as unfinished,
				       ((SELECT COUNT(*) FROM todoapp.subtask WHERE status='completed' AND todoapp.subtask.taskID=:id)*100/COUNT(*)) as finished FROM todoapp.subtask WHERE todoapp.subtask.taskID=:id");
            $this->bind(":id", $this->taskID);
            $row = $this->single();
            return $row;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return;
        }
    }
}
