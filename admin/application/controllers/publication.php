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
				$myPublication->userId = $publication->getUserId();
				$myPublication->creationDate = $publication->getCreationDate();
				$myPublication->tittle = $publication->getTittle();
				$myPublication->description = $publication->getDescription();
				$myPublication->expirationDate = $publication->getExpirationDate();
				$myPublication->categoryId = $publication->getCategoryId();
				$myPublication->subcategoryId = $publication->getSubcategoryId();
				$myPublication->views = $publication->getViews();

				$return["data"][$key] = $myPublication;
			 } 
		}

		echo json_encode($return);
	}

	public function save()
	{
		$arrOptions['id'] = ($this->input->post('id') > 0) ? $this->input->post('id') : 0;
		$arrOptions['userId'] = $this->input->post('userId');
		$arrOptions['creationDate'] = $this->input->post('creationDate');
		$arrOptions['tittle'] = $this->input->post('tittle');
		$arrOptions['description'] = $this->input->post('description');
		$arrOptions['expirationDate'] = $this->input->post('expirationDate');
		$arrOptions['categoryId'] = $this->input->post('categoryId');
		$arrOptions['subcategoryId'] = $this->input->post('subcategoryId');
		$arrOptions['views'] = $this->input->post('views');

		if($arrOptions['id'] > 0){
			$publication = CI_Publication::getById($id);
			$publication->setUserId($arrOptions['userId']);
			$publication->setCreationDate($arrOptions['creationDate']);
			$publication->setTittle($arrOptions['tittle']);
			$publication->setDescription($arrOptions['description']);
			$publication->setExpirationDate($arrOptions['expirationDate']);
			$publication->setCategoryId($arrOptions['categoryId']);
			$publication->setSubcategoryId($arrOptions['subcategoryId']);
			$publication->setViews($arrOptions['views']);
		}else{
			$object = new stdClass();
			$object->userId = $arrOptions['userId'];
			$object->creationDate = $arrOptions['creationDate'];
			$object->tittle = $arrOptions['tittle'];
			$object->description = $arrOptions['description'];
			$object->expirationDate = $arrOptions['expirationDate'];
			$object->categoryId = $arrOptions['categoryId'];
			$object->subcategoryId = $arrOptions['subcategoryId'];
			$object->views = $arrOptions['views'];
			$publication = CI_Publication::getInstance($object);
		}
		
		if($publication->save()){
			$return["result"] = "OK";

			$myPublication = new stdClass();
			$myPublication->id = $publication->getId();
			$myPublication->userId = $publication->getUserId();
			$myPublication->creationDate = $publication->getCreationDate();
			$myPublication->tittle = $publication->getTittle();
			$myPublication->description = $publication->getDescription();
			$myPublication->expirationDate = $publication->getExpirationDate();
			$myPublication->categoryId = $publication->getCategoryId();
			$myPublication->subcategoryId = $publication->getSubcategoryId();
			$myPublication->views = $publication->getViews();

			$return["data"] = $myPublication;
		}else{
			$return["result"] = "NOOK";
		}
		echo json_encode($return);
	}
}