<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Account extends REST_Controller{

	public function confirm_get(){

		$status = 404;
		$return["result"] = "NOOK";
		$token = $this->get('token');
		
		$data = CI_Account::isAvailableToken($token);
		if($data){
			if (CI_Account::confirm($data->userId)){
				$status = 200;
				$return["result"] = "OK";
			}
		}else{
			$status = 401;
		}		
		
		$this->response($return, $status);
	}

	public function index_put(){

		$arrOptions['id'] = 0;
		$arrOptions['email'] = $this->put('email');
		$arrOptions['password'] = $this->put('password');
		$arrOptions['name'] = $this->put('name');
		
		$user = new CI_User();
		$user->setEmail($arrOptions['email']);
		$user->setPassword($arrOptions['password']);
		$user->setName($arrOptions['name']);
		
		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";

		if($user->save()){
			$myUser = new stdClass();
			$myUser->id = $user->getId();
			$myUser->email = $user->getEmail();
			$myUser->name = $user->getName();

			CI_Account::create($myUser);

			$status = 200;
			$return["result"] = "OK";
			$return["data"] = $myUser;
		} 

		$this->response($return, $status);
	}

}

?>