<?php

class Validation{

	private $passed;
	public static $errors = [];

	private function addError($item, $error){
		self::$errors[$item] = $error;
	}

	public function errors(){
		return self::$errors;
	}

	public function passed(){
		return $this->passed;
	}

    // Check input and content
	public function check($source, $items = [])
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);

				if ($rule === "required" && empty($value)) {
					switch ($item) {
						case 'firstname':
						    $this->addError($item, "{$item} est obligatoire !");
							break;
						case 'lastname':
							$this->addError($item, "{$item} est obligatoire !");
							break;
						case 'email':
							$this->addError($item, "{$item} est obligatoire !");
							break;
						case 'password':
							$this->addError($item, "{$item} est obligatoire !");
							break;						
						default:

							break;
					}
			    }elseif(!empty($value)){
		        	switch ($rule) {
		        		case 'min':
		        			if (strlen($value) < $rule_value) {
		        				$this->addError($item, "{$item} doit contenir un minimum {$rule_value} caractères");
		        			}
		        			break;
		        		case 'max':
		        		    if (strlen($value) > $rule_value) {
		        				$this->addError($item, "{$item} peut contenir un maximum {$rule_value} caractères");
		        			}
		        		break;
		        		case 'text':
		        		    if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
		        			$this->addError($item, "{$item} ne peut contenir que des lettres");
		        		    }
		        		break;
		        		case 'email':
		        		   if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)) {
						   $this->addError($item, "Saisir un email valide {$item}");
						   }
		        		default:		        			
		        			break;
		        	}
		        }				
			}			
		}
		if (empty(self::$errors)) {
			$this->passed = true;
		}
		return $this;
	}

}