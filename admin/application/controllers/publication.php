<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Publication extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
		//checkLogin();
	}

	public function index(){}
	
	public function getPublications()
	{
		$return["result"] = "NOOK";
		$publications = CI_Publication::getPublications();
		if($publications){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($publications as $key => $publication) {
			 	$myPublication = new stdClass();
				$myPublication->id = $publication->getId();
				$myPublication->user_id = $publication->getuser_id();
				$myPublication->creation_date = $publication->getcreation_date();
				$myPublication->tittle = $publication->getTittle();
				$myPublication->description = $publication->getDescription();
				$myPublication->expiration_date = $publication->getexpiration_date();
				$myPublication->category_id = $publication->getcategory_id();
				$myPublication->subcategory_id = $publication->getSubcategory_id();
				$myPublication->views = $publication->getViews();

				$return["data"][$key] = $myPublication;
			 } 
		}

		echo json_encode($return);
	}

	public function save()
	{
		$arrOptions['id'] = ($this->input->post('id') > 0) ? $this->input->post('id') : 0;
		$arrOptions['user_id'] = $this->input->post('user_id');
		$arrOptions['creation_date'] = $this->input->post('creation_date');
		$arrOptions['tittle'] = $this->input->post('tittle');
		$arrOptions['description'] = $this->input->post('description');
		$arrOptions['expiration_date'] = $this->input->post('expiration_date');
		$arrOptions['category_id'] = $this->input->post('category_id');
		$arrOptions['subcategory_id'] = $this->input->post('subcategory_id');
		$arrOptions['views'] = $this->input->post('views');

		if($arrOptions['id'] > 0){
			$publication = CI_Publication::getById($arrOptions['id']);
			$publication->setUser_id($arrOptions['user_id']);
			$publication->setCreation_date($arrOptions['creation_date']);
			$publication->setTittle($arrOptions['tittle']);
			$publication->setDescription($arrOptions['description']);
			$publication->setExpiration_date($arrOptions['expiration_date']);
			$publication->setCategory_id($arrOptions['category_id']);
			$publication->setSubcategory_id($arrOptions['subcategory_id']);
			$publication->setViews($arrOptions['views']);
		}else{
			$object = new stdClass();
			$object->user_id = $arrOptions['user_id'];
			$object->creation_date = $arrOptions['creation_date'];
			$object->tittle = $arrOptions['tittle'];
			$object->description = $arrOptions['description'];
			$object->expiration_date = $arrOptions['expiration_date'];
			$object->category_id = $arrOptions['category_id'];
			$object->subcategory_id = $arrOptions['subcategory_id'];
			$object->views = $arrOptions['views'];
			$publication = CI_Publication::getInstance($object);
		}
		
		if($publication->save()){
			$return["result"] = "OK";

			$myPublication = new stdClass();
			$myPublication->id = $publication->getId();
			$myPublication->user_id = $publication->getUser_id();
			$myPublication->creation_date = $publication->getCreation_date();
			$myPublication->tittle = $publication->getTittle();
			$myPublication->description = $publication->getDescription();
			$myPublication->expiration_date = $publication->getExpiration_date();
			$myPublication->category_id = $publication->getCategory_id();
			$myPublication->subcategory_id = $publication->getSubcategory_id();
			$myPublication->views = $publication->getViews();

			$return["data"] = $myPublication;
		}else{
			$return["result"] = "NOOK";
		}
		echo json_encode($return);
	}
	
	public function delete() 
	{
		$error = $info = $success = "";
		$return["result"] = "NOOK";
		$id = $this->input->post('id');
		
		if($id > 0){
			$publication = CI_Publication::getById($id);
			if($publication->delete()){
				$return["result"] = "OK";
			}
		}
		
		echo json_encode($return);	
	}

}