<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Authentication extends REST_Controller{

	public function signin_get(){
		$arrOptions['email'] = $this->get('username');
		$arrOptions['password'] = $this->get('password');

		$data = CI_Authentication::signin($arrOptions); 

		$status = 403;
		$return["result"] = "NOOK";
		if($data){
			$status = 200;
			$myUser = new stdClass();
			$myUser->id = $data['user']->getId();
			$myUser->email = $data['user']->getEmail();
			$myUser->name = $data['user']->getName();
			$myUser->lastName = $data['user']->getLastName();

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