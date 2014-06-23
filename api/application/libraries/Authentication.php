<?php

class CI_Authentication {

	private static function generateToken($userId){
		$CI = & get_instance();
		$CI->load->library("JWT");

	    return $CI->jwt->encode(array(
	      'userId' => $userId,
	      'issuedAt' => time(),
	      'ttl' => time() + TOKEN_TTL
	    ), SECRET);
	}

	public static function login($options){
		$CI = & get_instance();
		$CI->load->library("JWT");
		$CI->load->model('user_model');
		$results = $CI->user_model->getByUsernameAndPassword($options);
		$return = array();
		if(!empty($results)){
			$user = CI_User::getInstance($results[0]);			
			$token = CI_Authentication::generateToken($user->getId());
			$return = array(
				'user' => $user,
				'token' => $token
			);
		}
		return $return;
	}

	public static function isLoggedIn($token){
		$CI = & get_instance();
		$CI->load->library("JWT");

		$return = false;
		try{
			$payload = $CI->jwt->decode($token, SECRET);
			$return = true;
		}
		catch (Exception $e){
			log_message('error', "Authentication Error: " . $e);	
		}

		return $return;
	}
}

?>
