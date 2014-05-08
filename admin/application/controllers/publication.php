<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Publication extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
		//checkLogin();
	}

	public function index(){}

	public function getRequests()
	{	
		$return["result"] = "NOOK";
		$userId = ($this->input->post('userId') > 0) ? $this->input->post('userId') : 0;
		$publications = CI_Publication::getRequests($userId);
		if($publications){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($publications as $key => $publication) {
				$myPublication = new stdClass();
				$myPublication->publicationId = $publication->getPublicationId();
				$myPublication->userId = $publication->getUserId();
				$myPublication->publicationTypeId = $publication->getPublicationTypeId();
				$myPublication->creationDate = $publication->getCreationDate();
				$myPublication->title = $publication->getTitle();
				$myPublication->description = $publication->getDescription();
				$myPublication->expirationDate = $publication->getExpirationDate();
				$myPublication->categoryId = $publication->getCategoryId();
				$myPublication->subcategoryId = $publication->getSubcategoryId();
				$myPublication->views = $publication->getViews();
				$myPublication->processStateId = $publication->getProcessStateId();
				$myPublication->objectId = $publication->getObjectId();
				$myPublication->quantity = $publication->getQuantity();

				$return["data"][$key] = $myPublication;
			 } 
		}
		echo json_encode($return);
	}

	public function getOffers()
	{
		$return["result"] = "NOOK";
		$userId = ($this->input->post('userId') > 0) ? $this->input->post('userId') : 0;
		$publications = CI_Publication::getOffers($userId);
		if($publications){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($publications as $key => $publication) {
				$myPublication = new stdClass();
				$myPublication->publicationId = $publication->getPublicationId();
				$myPublication->userId = $publication->getUserId();
				$myPublication->publicationTypeId = $publication->getPublicationTypeId();
				$myPublication->creationDate = $publication->getCreationDate();
				$myPublication->title = $publication->getTitle();
				$myPublication->description = $publication->getDescription();
				$myPublication->expirationDate = $publication->getExpirationDate();
				$myPublication->categoryId = $publication->getCategoryId();
				$myPublication->subcategoryId = $publication->getSubcategoryId();
				$myPublication->views = $publication->getViews();
				$myPublication->processStateId = $publication->getProcessStateId();
				$myPublication->objectId = $publication->getObjectId();
				$myPublication->quantity = $publication->getQuantity();
				$myPublication->processStateIdOffer = $publication->getProcessStateIdOffer();
				$myPublication->offerTypeId = $publication->getOfferTypeId();
				$myPublication->quantityUsersToPaused = $publication->getQuantityUsersToPaused();

				$return["data"][$key] = $myPublication;
			 } 
		}
		echo json_encode($return);
	}

	public function getById(){
		$publicationId = $this->input->post('publicationId');
		$return["result"] = "NOOK";
		$publication = CI_Publication::getById($publicationId);

		if($publication){
			$return["result"] = "OK";
			$return["data"] = "";
			
			$myPublication = new stdClass();
			$myPublication->publicationId = $publication->getPublicationId();
			$myPublication->userId = $publication->getUserId();
			$myPublication->publicationTypeId = $publication->getPublicationTypeId();
			$myPublication->creationDate = $publication->getCreationDate();
			$myPublication->title = $publication->getTitle();
			$myPublication->description = $publication->getDescription();
			$myPublication->expirationDate = $publication->getExpirationDate();
			$myPublication->categoryId = $publication->getCategoryId();
			$myPublication->subcategoryId = $publication->getSubcategoryId();
			$myPublication->views = $publication->getViews();
			$myPublication->processStateId = $publication->getProcessStateId();
			$myPublication->objectId = $publication->getObjectId();
			$myPublication->quantity = $publication->getQuantity();
			if($myPublication->publicationTypeId == 1){
				$myPublication->processStateIdOffer = $publication->getProcessStateIdOffer();
				$myPublication->offerTypeId = $publication->getOfferTypeId();
				$myPublication->quantityUsersToPaused = $publication->getQuantityUsersToPaused();				
			}
			$return["data"] = $myPublication;
		}
		echo json_encode($return);
	}

	public function save(){

		$arrOptions['publicationId'] = ($this->input->post('publicationId') > 0) ? $this->input->post('publicationId') : 0;
		$arrOptions['userId'] = $this->input->post('userId');
		$arrOptions['publicationTypeId'] = $this->input->post('publicationTypeId');
		$arrOptions['creationDate'] = $this->input->post('creationDate');
		$arrOptions['title'] = $this->input->post('title');
		$arrOptions['description'] = $this->input->post('description');
		$arrOptions['expirationDate'] = $this->input->post('expirationDate');
		$arrOptions['categoryId'] = $this->input->post('categoryId');
		$arrOptions['subcategoryId'] = $this->input->post('subcategoryId');
		$arrOptions['views'] = $this->input->post('views');
		$arrOptions['processStateId'] = $this->input->post('processStateId');
		$arrOptions['objectId'] = $this->input->post('objectId');
		$arrOptions['quantity'] = $this->input->post('quantity');
		$arrOptions['processStateIdOffer'] = $this->input->post('processStateIdOffer');
		$arrOptions['offerTypeId'] = $this->input->post('offerTypeId');
		$arrOptions['quantityUsersToPaused'] = $this->input->post('quantityUsersToPaused');

		if($arrOptions['publicationId'] > 0){
			$publication = CI_Publication::getById($arrOptions['publicationId']);
		}else{
			$publication = new CI_Publication();
		} 
		
		$publication->setUserId($arrOptions['userId']);
		$publication->setPublicationTypeId($arrOptions['publicationTypeId']);
		$publication->setCreationDate($arrOptions['creationDate']);
		$publication->setTitle($arrOptions['title']);
		$publication->setDescription($arrOptions['description']);
		$publication->setExpirationDate($arrOptions['expirationDate']);
		$publication->setCategoryId($arrOptions['categoryId']);
		$publication->setSubcategoryId($arrOptions['subcategoryId']);
		$publication->setViews($arrOptions['views']);
		$publication->setProcessStateId($arrOptions['processStateId']);
		$publication->setObjectId($arrOptions['objectId']);
		$publication->setQuantity($arrOptions['quantity']);
		$publication->setProcessStateIdOffer($arrOptions['processStateIdOffer']);
		$publication->setOfferTypeId($arrOptions['offerTypeId']);
		$publication->setQuantityUsersToPaused($arrOptions['quantityUsersToPaused']);
		if ($arrOptions['publicationTypeId'] == 1) {
			$publication->setProcessStateIdOffer($arrOptions['processStateIdOffer']);
			$publication->setOfferTypeId($arrOptions['offerTypeId']);
			$publication->setQuantityUsersToPaused($arrOptions['quantityUsersToPaused']);
		}

		if($publication->save()){
			$return["result"] = "OK";

			$myPublication = new stdClass();
			$myPublication->publicationId = $publication->getPublicationId();
			$myPublication->userId = $publication->getUserId();
			$myPublication->publicationTypeId = $publication->getPublicationTypeId();
			$myPublication->creationDate = $publication->getCreationDate();
			$myPublication->title = $publication->getTitle();
			$myPublication->description = $publication->getDescription();
			$myPublication->expirationDate = $publication->getExpirationDate();
			$myPublication->categoryId = $publication->getCategoryId();
			$myPublication->subcategoryId = $publication->getSubcategoryId();
			$myPublication->views = $publication->getViews();
			$myPublication->processStateId = $publication->getProcessStateId();
			$myPublication->objectId = $publication->getObjectId();
			$myPublication->quantity = $publication->getQuantity();
			$myPublication->processStateIdOffer = $publication->getProcessStateIdOffer();
			$myPublication->offerTypeId = $publication->getOfferTypeId();
			$myPublication->quantityUsersToPaused = $publication->getQuantityUsersToPaused();

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

	public function getDidDonations($userId){
		//TODO: OBTENER TODAS LAS DONACIONES HECHAS POR EL USUARIO (JOIN PUBLICATIONS - DONATIONS) 
	}

	public function getReceivedDonations($userId){
		//TODO: OBTENER TODAS LAS DONACIONES QUE RECIVIO EL USUARIO. (JOIN PUBLICATIONS - DONATIONS) 
		//FILTRANDO POR EL ID DE USUARIO QUE ESTA EN LA TABLA DONATIONS
	}
}