<?php

class TodoModel extends Model{

    private $order;
    private $table_name = "todo";
    public $todoID;

    public function order($order)
    {
		$this->order = $order;
	}

	public function Index($id)
	{
		$this->query("SELECT * FROM " . $this->table_name 
			                          . " WHERE id=:id"
			                          . $this->order);
		$this->bind(":id", $id);
		$rows = $this->resultSet();
		return $rows;
	}

	public function add()
	{
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['create_todo']) {
			$this->query("INSERT INTO todo (todo.name, date_creation, user_id)
				VALUES(:name, now(), :id)");
			$this->bind(":name", $post['name']);
			$this->bind(":id", $post['id']);
			$this->execute();

			if ($this->lastInsertId()) {
				header('Location: ' . ROOT_PATH . 'todos');
			}
		}
		return;
	}

	public function update($id)
	{
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['update_todo']) {
			$this->query("UPDATE " . $this->table_name . " SET name=:name WHERE id=:id");
			$this->bind(":name", $post['name']);
			$this->bind(":id", $post['todo_id']);
			$this->execute();

			header('Location: ' . ROOT_PATH . 'todos');
			return;
		}
		
		$this->query("SELECT * FROM " . $this->table_name . " WHERE id=:id");
		$this->bind(":id", $id);
		$row = $this->single();
		return $row;
	}

	public function delete()
	{
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if ($post['delete_todo_list']) {

			$this->query("DELETE FROM " . $this->table_name . " WHERE id=:id");
			$this->bind(":id", $post['todo_id']);
			$this->execute();
	    }
	    return;
	}

	public function tasks(){
		try{
	        $this->query("SELECT id, name, date_creation FROM todo ");

			$row = $this->resultSet();
	    	return $row;
		}catch(Exception $e){
			$_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
	        return;
		}    	
    }

    public function subtasks(){
        try{
            $this->query("SELECT id, task.name, priority, deadline, status, todoID FROM task ");

            $row = $this->resultSet();
            return $row;
        }catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
            return;
        }
    }
		
}