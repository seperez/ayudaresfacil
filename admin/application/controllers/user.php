<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
		checkLogin();
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
	
	public function save($id, $isMobile = FALSE)
	{
		$arrPost['id'] = (isset($id) && $id > 0) ? $id : 0;
		$arrPost['roleId'] = $this->input->post('cmbRoles');
		$arrPost['username'] = $this->input->post('txtUsername');
		$arrPost['password'] = $this->input->post('txtPassword');
		$arrPost['name'] = $this->input->post('txtName');
		$arrPost['surname'] = $this->input->post('txtSurname');
		$arrPost['email'] = $this->input->post('txtEmail');
		
		if(getRoleId() == 2){
			//ADMINISTRATIVOS SOLO PUEDEN DAR DE ALTA CLIENTES.
			$arrPost['roleId'] = 4;
		}
		
		if($arrPost['id'] > 0){
			$user = CI_User::getById($id);
			$user->setRoleId($arrPost['roleId']);
			$user->setUsername($arrPost['username']);
			$user->setPassword($arrPost['password']);
			$user->setName($arrPost['name']);
			$user->setSurname($arrPost['surname']);
			$user->setEmail($arrPost['email']);
		}else{
			$object->id = 0;
			$object->roleId = $arrPost['roleId'];
			$object->username = $arrPost['username'];
			$object->password = $arrPost['password'];
			$object->name = $arrPost['name'];
			$object->surname = $arrPost['surname'];
			$object->email = $arrPost['email'];
			$user = CI_User::getInstance($object);
		}
		
		if(!$isMobile){
			if($user->save()){
				$this->session->set_flashdata('msgSuccess','El registro fue modificado con exito.');
				redirect("user/index/");
			}else{
				$this->session->set_flashdata('msgError','Surgió un error al intentar realizar la operación requerida.');
				$view = "admin/form_user";
				$data['arrPost'] = $arrPost;
				$this->load->view($view,$data);
			}			
		}else{
			if($user->save()){
				$return["error"] = FALSE;
				$return["message"] = "El cliente fue dado de alta con exito!";
			}else{
				$return["error"] = TRUE;
				$return["message"] = "Surgió un error al intentar dar de alta el cliente!";	
			}
			echo json_encode($return);
		}
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
