<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller{

	public function index_get(){

		$id = $this->get("id"); 
		$users =  $id ? CI_User::getById($id) : CI_User::getUsers();

		$return["result"] = "NOOK";
		if($users){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($users as $key => $user) {
			 	$myUser = new stdClass();
				$myUser->id = $user->getId();
				$myUser->email = $user->getEmail();
				$return["data"][$key] = $myUser;
			 } 
		}

		if($return)
            $this->response($return, 200);
        else
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
	}
	
	public function save()
	{
		$arrOptions['id'] = ($this->input->post('id') > 0) ? $this->input->post('id') : 0;
		$arrOptions['email'] = $this->input->post('email');
		$arrOptions['password'] = $this->input->post('password');
		$arrOptions['name'] = $this->input->post('name');

		if($arrOptions['id'] > 0){
			$user = CI_User::getById($id);
			$user->setEmail($arrOptions['email']);
			$user->setPassword($arrOptions['password']);
			$user->setName($arrOptions['name']);
		}else{
			$user = new CI_User();
			$user->setEmail($arrOptions['email']);
			$user->setPassword($arrOptions['password']);
			$user->setName($arrOptions['name']);
		}
		
		if($user->save()){
			$return["result"] = "OK";
			$myUser = new stdClass();
			$myUser->id = $user->getId();
			$myUser->email = $user->getEmail();

			$return["data"] = $myUser;
		}else{
			$return["result"] = "NOOK";
		}
		echo json_encode($return);
	}
	
	public function delete() 
	{
		$error = $info = $success = "";
		$return["result"] = "NOOK";
		$id = ($this->input->post('id') > 0) ? $this->input->post('id') :0;
		if($id > 0){

			$user = CI_User::getById($id);
			if($user->delete()){
				$return["result"] = "OK";
			}
		}
		
		echo json_encode($return);	
	}

	public function confirmAccount() 
	{
		$error = $info = $success = "";
		$return["result"] = "NOOK";
		$id = ($this->input->get_post('id') > 0) ? $this->input->get_post('id') :0;
		if($id > 0){
			$user = CI_User::getById($id);
			if ($user && $user->confirmAccount())
				$return["result"] = "OK";
		}		
		echo json_encode($return);	
	}
}
