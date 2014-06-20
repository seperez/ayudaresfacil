<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
		//checkLogin();
	}

	public function index(){}
	
	public function getUsers()
	{
		$return["result"] = "NOOK";
		$users = CI_User::getUsers();
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

		echo json_encode($return);
	}

	public function login()
	{
		$arrOptions['email'] = $this->input->post('email');
		$arrOptions['password'] = $this->input->post('password');
		$user = CI_User::login($arrOptions);
		if($user){
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

	public function registrationConfirm() 
	{
		$error = $info = $success = "";
		$return["result"] = "NOOK";
		$id = ($this->input->get_post('id') > 0) ? $this->input->get_post('id') :0;
		if($id > 0){
			$user = CI_User::getById($id);
			if ($user && $user->confirmation())
				$return["result"] = "OK";
		}
		
		echo json_encode($return);	
	}
}
