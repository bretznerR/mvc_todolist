<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class UserModel extends Model{

	public $id;
	public $tk;
	private $pass = false;

	public function register()
	{
		return;
	}

	public function registerUser()
	{
        
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($post['register']) {

        	$this->query("SELECT * FROM user WHERE email=:email");
			$this->bind(":email", $post['email']);

			if ($this->single() > 0) {
				Helper::setMessage("Cet email existe déjà !", "error");
				return false;
		    }else{
		    	$password = password_hash($post['password'], PASSWORD_DEFAULT);
		        $token = bin2hex(mt_rand(10,40000));

	            $this->query("INSERT INTO user SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, token=:token, active=0, register_date=now()");

				$this->bind(":firstname", $post['firstname']);
				$this->bind(":lastname", $post['lastname']);
				$this->bind(":email", $post['email']);
				$this->bind(":password", $password);
				$this->bind(":token", $token);
				
				$this->execute();

				if ($this->lastInsertId()) {
                	$user = $this->getUser($post['email']);
				    $_SESSION['id'] = $user['id'];
				    //$this->sendEmail($user['email'], $user['id'], $token);
                	return true;
                }

		    }
        }
		return false;
	}

	private function getUser($email){
		try{
	        $this->query("SELECT * FROM user WHERE email='$email'");
			$row = $this->single();
			return $row;
		}catch(Exception $e){
            $_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
	        return;
		}
		
	}

	public function sendEmail($email, $id, $token){

        $link = $_SERVER['HTTP_HOST'] . '/users/activate/'.$id.'/'.$token;
        
		$mail = new PHPMailer(true);                           // Passing `true` enables exceptions
		try {
	    //Server settings
		$mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
	    $mail->SMTPDebug;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = '';                 // SMTP username
	    $mail->Password = '';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    //$mail->setFrom('from@example.com', 'Mailer');
	    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
	    //$mail->addAddress('ellen@example.com');               // Name is optional
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Here is the subject';
	    $message = '<div>';
	    $message .= '<h6>Your activation link</h6>';
	    $message .= '<a href="' . $link . '">Activate account</a>';
	    $message .= '</div>';

		$mail->Body = $message;
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    
	    $mail->addAddress($email, 'Nouvel utilisateur');
	    $mail->send();
	    Helper::setMessage("Vous êtes inscrit. Vérifiez votre e-mail pour le lien d'activation.", "success");
		}catch(Exception $e) {		   
		    Helper::setMessage('Erreur de l\'expéditeur: ' . $mail->ErrorInfo, "error");
		}
    }

    public function login()
    {
    	return;
    }

	public function loginUser()
	{
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if ($post['login']) {

			//$this->query("SELECT * FROM user WHERE email=:email AND active=1");
            $this->query("SELECT * FROM user WHERE email=:email");
			$this->bind(":email", $post['email']);
			$row = $this->single();

			if (isset($row)) {
				$this->query("SELECT * FROM user WHERE id='" . $row['id'] . "' ");
				$row = $this->single();

				if ($post['email'] !== $row['email']) {
					Helper::setMessage("Mail incorrecte!", "error");
					return;
				}

				if (password_verify($post['password'], $row['password'])) {
                    $this->updateLoginTime($row['id']);
					$_SESSION['is_logged'] = true;
				    $_SESSION['USER'] = [
					"ID" => $row['id'],
					"firstname" => $row['firstname'],
					"lastname" => $row['lastname'],
					"EMAIL" => $row['email'],
					"last_login"=>$row['last_login']
					];
					header('Location: ' . ROOT_PATH . 'home');
					
				}else{
					Helper::setMessage("Mauvais mot de passe!", "error");
				}
		    }
		}			
		return;
	}

	public function activate()
	{
	    try{
	        $this->query("UPDATE user SET active=1 WHERE id=:id AND token=:token");
			$this->bind(":id", $this->id);
			$this->bind(":token", $this->tk);
			$this->execute();
			unset($_SESSION['activate']);
			Helper::setMessage("Vous pouvez désormais vous connecter.", "success");
			header('Location: ' . ROOT_PATH . 'users/login');
	    }catch(Exception $e){
	    	$_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
	        return;
	    }			
	}

	private function updateLoginTime($id)
	{
		try{
	        $this->query("UPDATE user SET last_login=now() WHERE id='$id'");
			$this->execute();
	    }catch(Exception $e){
	    	$_SESSION['error'] = "Erreur de connexion à la BDD : " . $e->getMessage();
	        return;
	    }
		
	}
}