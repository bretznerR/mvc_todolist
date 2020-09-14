<?php 

class Users extends Controller{

	protected function register()
	{
        
        $viewmodel = new UserModel();
        $data = [];
		if (Helper::inputExists() && $_POST['register']) {
			$validation = new Validation();
			$validation->check($_POST, [
				"firstname"=>["required"=>true, "min"=>2, "max"=>30, "text"=>true],
				"lastname"=>["required"=>true, "min"=>2, "max"=>30, "text"=>true],
				"email"=>["required"=>true, "email"=>true],
				"password"=>["required"=>true, "min"=>6]
			]);

			if ($validation->passed()) {
				$result = $viewmodel->registerUser();
                $result ? header("Location: " . ROOT_PATH . "users/login") : '';
			}else{
				
				$data = ['errors'=>$validation->errors()];
			}
		}

		$this->ReturnView($viewmodel->register(), true, $data);
		
	}

	protected function login()
	{
		$viewmodel = new UserModel();
        $data = [];
		if (Helper::inputExists() && $_POST['login']) {
			$validation = new Validation();
			$validation->check($_POST, [
				"email"=>["required"=>true, "email"=>true],
				"password"=>["required"=>true, "min"=>6]
			]);

			if ($validation->passed()) {
				$viewmodel->loginUser();
			}else{
				$data = ['errors'=>$validation->errors()];
			}
		}

		

		$this->ReturnView($viewmodel->login(), true, $data);
	}

	public function logout()
	{   
		unset($_SESSION['is_logged']);
		unset($_SESSION['USER']);
		session_destroy();
		header('Location: ' . ROOT_PATH . 'users/login');
	}

	public function activate()
	{
		$viewmodel = new UserModel();

		if (isset($_GET['active']) && isset($_GET['id'])) {
		 	$viewmodel->tk = $_GET['active'];
		    $viewmodel->id = $_GET['id'];
		 } 
		
        $this->ReturnView($viewmodel->activate(), true);
        		
	}
	
}