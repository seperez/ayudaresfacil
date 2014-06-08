<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 	
	}

	public function getById(){
		$publicationId = $this->input->post('publicationId');
		$return["result"] = "NOOK";
		$publication = CI_Publication::getById($publicationId);

		if($publication){
			$return["result"] = "OK";
			$return["data"] = "";
			
			$myPublication = new stdClass();
			$myPublication->id = $publication->getId();	
			$myPublication->creationDate = $publication->getCreationDate();
			$myPublication->title = $publication->getTitle();
			$myPublication->description = $publication->getDescription();
			$myPublication->expirationDate = $publication->getExpirationDate();
			$myPublication->category = $publication->getCategory();
			$myPublication->subcategory = $publication->getSubcategory();
			$myPublication->views = $publication->getViews();
			$myPublication->processState = $publication->getProcessState();
			$myPublication->object = $publication->getObject();
			$myPublication->quantity = $publication->getQuantity();
			
			$return["data"] = $myPublication;
		}
		return $return;
		//echo json_encode($return);
	}
}