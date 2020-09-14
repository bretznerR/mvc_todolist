<?php

require "../config.php";
require "../classes/Model.php";
require "../classes/Helper.php";

class TaskModel extends Model{


    public $id;
    public $name;
    public $priority;
    public $deadline;
    public $status;
    public $todoID;
    public $where;
    public $order;

    public function redirect($var)
    {
        if (!isset($var)) {
            header("Location: " . ROOT_PATH . "users/login");
        }
    }

    public function getTasksById()
    {
        try{
            $this->query("SELECT task.id as taskid, priority, deadline, status, 
		    task.name, DATEDIFF(deadline, CURDATE()) as datediff FROM todo left OUTER JOIN task 
		    ON task.todoID=todo.id WHERE todo.id=:id");
            $this->bind(":id", $this->todoID);
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

    public function createTask()
    {
        try{
            $this->query("INSERT INTO task (name, priority, deadline, todoID)
		                  VALUES (:name, :priority, :deadline, :todoID)");
            $this->bind(":name", $this->name);
            $this->bind(":priority", $this->priority);
            $this->bind(":deadline", $this->deadline);
            $this->bind(":todoID", $this->id);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }


    }

    public function updateTask()
    {
        try{
            $this->query("UPDATE task SET name=:name,
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

    public function deleteTasK()
    {
        try{
            $this->query("DELETE FROM task WHERE id=:id");
            $this->bind(":id", $this->id);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }

    }

    public function readOneTask()
    {
        try{
            $this->query("SELECT * FROM task WHERE id =" . $this->id);
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
            $this->todoID = $row['id'];
        }

    }

    public function finishTask()
    {
        try{
            $this->query("UPDATE task SET status='completed' WHERE id=:id");
            $this->bind(":id", $this->id);
            $this->execute();
            return true;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return false;
        }
    }

    public function todoInfo()
    {
        try{
            $this->query("SELECT status, COUNT(*) as total, (SELECT COUNT(*) FROM task WHERE status='no completed' AND todoID=:id) as unfinished,
				       ((SELECT COUNT(*) FROM task WHERE status='completed' AND todoID=:id)*100/COUNT(*)) as finished FROM task WHERE todoID=:id");
            $this->bind(":id", $this->todoID);
            $row = $this->single();
            return $row;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return;
        }
    }
}
