<?php

class CI_Account {
	public function create($user){

		$CI = & get_instance();
		$CI->load->library("JWT");
		$CI->load->model('user_model');
				
		$token = $CI->jwt->encode(array(
	      'userId' => $user->id,
	      'email' => $user->email,
	      'issuedAt' => time(),
	      'ttl' => time() + (60 * 60 * 24 * 7)
	    ), SECRET);
		$activationUrl = base_url()."account/confirm?token=".$token;

		$message = "";
		$message .= "<h3>Hola " . $user->name . "</h3>";
		$message .= "<p>" . "Te damos la bienvenida a <strong>Ayudar Es Fácil</strong>. " . "</p>";
		$message .= "<p>" . "Para finalizar tu registro haz click en el siguiente link:. " . "</p>";
		$message .= "<p><a href='". $activationUrl ."'>" . $activationUrl . "</a></p>";
		$message .= "<p>" . "Si el link no funciona copia y pega la url en tu navegador. " . "</p>";

		
	    $this->load->library('email');
	    $this->email->clear();
		$this->email->from('<accounts@ayudaresfacil.org>', 'Ayudar Es Fácil');
		$this->email->to($user->email); 
		$this->email->subject('Bienvenido a Ayudar Es Fácil');
		$this->email->message($message);	
		$this->email->send();
	}

	public function confirm($id){
		$CI =& get_instance();
		$CI->load->model('user_model');
		return $CI->user_model->confirmAccount($id);
	}

	public function delete(){
		
	}

	public static function isAvailableToken($token){
		$CI = & get_instance();
		$CI->load->library("JWT");

		$return = false;
		try{
			$return = $CI->jwt->decode($token, SECRET);
		}
		catch (Exception $e){
			log_message('error', "Confirmate Account Error: " . $e);	
		}

		return $return;
	}
}

?>