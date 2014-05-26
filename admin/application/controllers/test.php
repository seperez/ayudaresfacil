<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller{
    
	public function __construct(){
		parent::__construct();	
		//checkLogin();
	}
		
	public function index() {

        $phoneTypes = CI_PhoneType::getPhoneTypes();
        ma($phoneTypes);
    }    
}
