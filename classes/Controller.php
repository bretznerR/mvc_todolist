<?php

abstract class Controller{
	
	protected $request;
	protected $action;

	public function __construct($action, $request)
	{
		$this->action = $action;
		$this->request = $request;
	}

    // If user not looged --> go to login
	public function redirect()
	{
		if (!isset($_SESSION['is_logged'])) {
			header("Location: " . ROOT_PATH . "users/login");
		}
	}

	public function executeAction()
	{
		return $this->{$this->action}();//if action = "" then it is an index, $ this-> index ()
	}

    // return the view when is calling
	protected function ReturnView($viewmodel, $fullview, $data = [])
	{
		$view = 'views/' . get_class($this) . '/' . $this->action . '.php';
		if ($fullview) {
			require 'views/main.php';
		}else{
			require $view;
		}
	}
}