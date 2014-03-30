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
		$limit = 9999999999999;
		$offset = 0;
		if(getRoleId() == 2){
			$data["users"] = CI_User::listClients($limit, $offset);
		}else{
			$data["users"] = CI_User::listUsers($limit, $offset);	
		}
		$this->load->view('admin/list_user',$data);
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
		$arrOptions['id'] = ($this->input->post('Id') > 0) ? $this->post('Id') : 0;
		$arrOptions['email'] = $this->input->post('Email');
		$arrOptions['password'] = $this->input->post('Password');
		$arrOptions['name'] = $this->input->post('Name');

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
			$return["error"] = "NOOK";
		}
		echo json_encode($return);
	}
	
	public function delete($id) 
	{
		$error = $info = $success = "";
		$user = CI_User::getById($id);
		
		if($user->delete())
			$this->session->set_flashdata('msgSuccess','El registro fue eliminado con exito.');	
		else
			$this->session->set_flashdata('msgError','Surgió un error al intentar realizar la operación requerida.'); 
		redirect("user/index/");		
	}
}
