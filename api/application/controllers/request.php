<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
	}

	public function index(){}

	public function getById(){
		$id = $this->input->get('publicationId');
		$return["result"] = "NOOK";
		$request = CI_Request::getById($id);	

		if($request){
			$return["result"] = "OK";
			$myRequest = CI_Request::getData($request);	
			$return["data"] = $myRequest;
		}
		echo json_encode($return);
	}
}