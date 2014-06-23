<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller{

	public function index_get(){
		
		checkIsLoggedIn($this);
		
		$id = $this->get("id"); 
		$users =  $id ? CI_User::getById($id) : CI_User::getUsers();

		$status = 404;
		$return["result"] = "NOOK";
		if($users){
			$status = 200;
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($users as $key => $user) {
			 	$myUser = new stdClass();
				$myUser->id = $user->getId();
				$myUser->email = $user->getEmail();
				$return["data"][$key] = $myUser;
			 } 
		}

        $this->response($return, $status);
	}
	
	public function index_post(){
		
		checkIsLoggedIn($this);

		$arrOptions['id'] = $this->post('id');;
		$arrOptions['email'] = $this->post('email');
		$arrOptions['password'] = $this->post('password');
		$arrOptions['name'] = $this->post('name');
		
		$user = CI_User::getById($id);
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

			$status = 200;
			$return["result"] = "OK";
			$return["data"] = $myUser;
		} 

		$this->response($return, $status);
	}
	
	public function index_delete(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";
		$id = ($this->input->post('id') > 0) ? $this->input->post('id') :0;
		
		if($id > 0){
			$user = CI_User::getById($id);
			if($user->delete()){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		
		$this->response($return, $status);
	}
}
