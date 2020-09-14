<?php 

class Home extends Controller{

	protected function Index()
	{
		$this->redirect();

		$viewmodel = new HomeModel();
		$this->ReturnView($viewmodel->Index(), true);
	}
}