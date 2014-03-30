<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
		//checkLogin();
	}

	public function index()
	{
		$limit = 99.99999999999;
		$offset = 0;
		if(getRoleId() == 2){
			$data["users"] = CI_User::listClients($limit, $offset);
		}else{
			$data["users"] = CI_User::listUsers($limit, $offset);	
		}
		$this->load->view('admin/list_user',$data);
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

	public function modify($id)
	{
		$limit = 9999999999999;
		$offset = 0;
		$data['user'] = CI_User::getById($id); 
		$data['userRoles'] = CI_User::listUserRoles($limit, $offset);
		$this->load->view('admin/form_user',$data);
	}
	
	public function add()
	{
		$limit = 9999999999999;
		$offset = 0;
		$data['userRoles'] = CI_User::listUserRoles($limit, $offset);
		$this->load->view('admin/form_user',$data);
	}
	
	public function save()
	{
		$arrOptions['id'] = ($this->input->post('id') > 0) ? $this->post('id') : 0;
		$arrOptions['email'] = $this->input->post('email');
		$arrOptions['password'] = $this->input->post('password');
		$arrOptions['name'] = $this->input->post('name');

		if($arrOptions['id'] > 0){
			$user = CI_User::getById($id);
			$user->setEmail($arrOptions['email']);
			$user->setPassword($arrOptions['password']);
			$user->setName($arrOptions['name']);
		}else{
			$object = new stdClass();
			$object->email = $arrOptions['email'];
			$object->password = $arrOptions['password'];
			$object->name = $arrOptions['name'];
			$user = CI_User::getInstance($object);
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

	public function confirmation() 
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
