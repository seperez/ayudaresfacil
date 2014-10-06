<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Authentication extends REST_Controller{
	
	public function index_get(){
		if($this->get('token')){
			$this->isLoggedIn();
		}else{
			$this->login();
		}
	}

	private function login(){
		$arrOptions['email'] = $this->get('username');
		$arrOptions['password'] = $this->get('password');

	

		$data = CI_Authentication::login($arrOptions); 

		$status = 404;
		$return["result"] = "NOOK";
		if($data){
			$myUser = new stdClass();
			$myUser->id = $data['user']->getId();
			$myUser->email = $data['user']->getEmail();

			$status = 200;
			$return["result"] = "OK";
			$return["data"] = $myUser;
			$return["token"] = $data['token'];
		}

        $this->response($return, $status);
	}

	private function isLoggedIn(){
		$token = $this->get('token');
		$return["isLoggedIn"] = CI_Authentication::isLoggedIn($token);

		$this->response($return, 200);	
	}
}