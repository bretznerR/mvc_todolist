<?php

class Bootstrap{

	private $controller;
	private $action;
	private $request;

    // Default controller and action
	public function __construct($request)
	{
		$this->request = $request;

		if ($this->request['controller'] == "") {
			$this->controller = "home";
		}else{
			$this->controller = $this->request['controller'];
		}

		if ($this->request['action'] == "") {
			$this->action = "index";// protected function Index in the Home class
		}else{
			$this->action = $this->request['action'];
		}
	}

	// Controller creation
	public function createController()
	{
		if (class_exists($this->controller)) {
            //restore the parent class from the given class, in this and each case the Controller
			$parents = class_parents($this->controller);

			if (in_array("Controller", $parents)) {

				if (method_exists($this->controller, $this->action)) {
					return new $this->controller($this->action, $this->request);
				}else{
					echo "La méthode n'existe pas !";
					return;
				}

			}else{
				echo "Contrôleur de base introuvable !";
				return;
			}
			
		}else{
			echo "La classe de contrôleur n'existe pas!";
			return;
		}
	}
}