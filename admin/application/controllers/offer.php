<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 	
		//checkLogin();
	}

	public function index(){}

	public function getById(){
		$id = $this->input->post('publicationId');
		$return["result"] = "NOOK";
		$offer = CI_Offer::getById($id);	

		if($offer){
			$return["result"] = "OK";
			$return["data"] = "";

			$myOffer = CI_Offer::getData($offer);		
			$return["data"] = $myOffer;
		}
		echo json_encode($return);
	}
}
