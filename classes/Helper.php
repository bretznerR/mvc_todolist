<?php 

class Helper{

	public static function inputExists($type = 'post'){
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;
			case 'get':
			return (!empty($_GET)) ? true : false;
				break;
			default:
				return false;
				break;
		}
	}

	public static function get($item){
		if (isset($_POST[$item])) {
			return $_POST[$item];
		}elseif(isset($_GET[$item])){
			return $_GET[$item];
		}
		return '';
	}

	public static function htmlout($param)
	{
		echo htmlspecialchars($param, ENT_QUOTES, 'UTF-8');
	}

	public static function dateFormat($date)
	{
		$newDate = date_create($date);
		echo date_format($newDate,"Y/m/d");
	}

	public static function setMessage($text, $type)
	{
		if ($type == "error") {
			$_SESSION['ERROR_MSG'] = $text;
		}elseif($type == "success"){
			$_SESSION['SUCCESS_MSG'] = $text;
		}
	}

    // Message prompt
	public static function writeMessage()
	{
		if (isset($_SESSION['ERROR_MSG'])) {
			echo "<div class='alert alert-danger'>" . $_SESSION['ERROR_MSG'] . "</div>";
			unset($_SESSION['ERROR_MSG']);
		}

		if (isset($_SESSION['SUCCESS_MSG'])) {
			echo "<div class='alert alert-success'>" . $_SESSION['SUCCESS_MSG'] . "</div>";
			unset($_SESSION['SUCCESS_MSG']);
		}
	}
}