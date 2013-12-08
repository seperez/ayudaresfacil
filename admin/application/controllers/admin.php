<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{
    
	public function __construct(){
		parent::__construct();	
		checkLogin();
	}
		
	public function index(){
		if(isLoggedIn())
			redirect(base_url()."admin/welcome");
		else
			$this->load->view('admin/login');
	}
		
	public function login()
	{
		$arrPost = array();	
		$arrPost['username'] = $this->input->post('txtUsername');
		$arrPost['password'] = $this->input->post('txtPassword');		
		
		$user = CI_User::login($arrPost['username'], $arrPost['password']);

		if($user) {
			setSessionData($user);
			redirect( base_url() . "admin/welcome" );
		} else {
			$data['msgError'] = "Datos incorrectos!";
		}
			
		$this->load->view('admin/login', $data);	
		
	}
		
	public function recoverPassword() 
	{
		$return = FALSE;	
		$user = CI_User::getByEmail($this->input->post('email'));
		if($user){
			$this->load->library('email');
			$this->email->from(SENDER_SYSTEM_EMAIL, APP_NAME);
			$this->email->to($user->getEmail()); 
			$this->email->subject('Recuperacion de Clave de Acceso');
			$this->email->message('Su clave de acceso al sistema es: ' . $user->getPassword());	
			
			if($this->email->send()) $return = TRUE;	
		}
		echo $return;
		die();
	}
	
	public function logout()
	{
		logout();
		redirect(base_url()."admin/index");
	}
	
	public function welcome() {
		$data['user'] = getLoggedinUser();
        $this->load->view('admin/welcome',$data);
   	}
	
	public function user() {
        redirect(base_url()."user/index");
    }
}
