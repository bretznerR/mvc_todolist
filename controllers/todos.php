<?php 

class Todos extends Controller{
	
	protected function Index()
	{
		$this->redirect();

		$viewmodel = new TodoModel();		


		if (isset($_POST['type']) && $_POST['type'] == 'oldest') {
	        $viewmodel->order(' ORDER BY date_creation DESC');
		}elseif (isset($_POST['type']) && $_POST['type'] == 'name'){
			$viewmodel->order(' ORDER BY name ASC');
		}

        if (isset($_POST['delete_todo_list'])) {
		   $viewmodel->delete();
		}
		$id = $_SESSION['USER']['ID'];
		$this->ReturnView($viewmodel->tasks(), true);

		
	}

	protected function add()
	{
		$this->redirect();

		$viewmodel = new TodoModel();
		$this->ReturnView($viewmodel->add(), true);
	}

	protected function update()
	{
		$this->redirect();
		
		$viewmodel = new TodoModel();
		$this->ReturnView($viewmodel->update($_GET['id']), true);
		
	}

	protected function tasks()
	{
		$this->redirect();
		$viewmodel = new TodoModel();

		if (isset($_GET['id'])) {
			$viewmodel->todoID = $_GET['id'];
		}
		
		$this->ReturnView($viewmodel->tasks(), true);
	}

    protected function subtasks()
    {
        $this->redirect();
        $viewmodel = new TodoModel();

        if (isset($_GET['id'])) {
            $viewmodel->todoID = $_GET['id'];
        }

        $this->ReturnView($viewmodel->subtasks(), true);
    }

}