<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Publication extends CI_Controller{
	public function __construct()
	{
		parent::__construct(); 	
		//checkLogin();
	}

	public function index(){}

	public function getOffersFavourites(){
		$error = $info = $success = "";
		$return["result"] = "NOOK";

		$userId = $this->input->post('userId');

		$publications = CI_Publication::getOffersFavourites($userId);
		if($publications){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($publications as $key => $publication) {
				$myPublication = new stdClass();
				$myPublication->publicationId = $publication->getPublicationId();
				$myPublication->user = $publication->getUser();
				$myPublication->type = $publication->getType();
				$myPublication->creationDate = $publication->getCreationDate();
				$myPublication->title = $publication->getTitle();
				$myPublication->description = $publication->getDescription();
				$myPublication->expirationDate = $publication->getExpirationDate();
				$myPublication->category = $publication->getCategory();
				$myPublication->subcategoryId = $publication->getSubcategoryId();
				$myPublication->views = $publication->getViews();
				$myPublication->processStateId = $publication->getProcessStateId();
				$myPublication->objectId = $publication->getObjectId();
				$myPublication->quantity = $publication->getQuantity();
				if($myPublication->type == 1){
					$myPublication->processStateIdOffer = $publication->getProcessStateIdOffer();
					$myPublication->offerTypeId = $publication->getOfferTypeId();
					$myPublication->quantityUsersToPaused = $publication->getQuantityUsersToPaused();				
				}
				$return["data"][$key] = $myPublication;
			 } 
		}
		echo json_encode($return);
	}

	public function getRequestsFavourites(){
		$error = $info = $success = "";
		$return["result"] = "NOOK";

		$userId = $this->input->post('userId');

		$publications = CI_Publication::getRequestsFavourites($userId);
		if($publications){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($publications as $key => $publication) {
				$myPublication = new stdClass();
				$myPublication->publicationId = $publication->getPublicationId();
				$myPublication->user = $publication->getUser();
				$myPublication->type = $publication->getType();
				$myPublication->creationDate = $publication->getCreationDate();
				$myPublication->title = $publication->getTitle();
				$myPublication->description = $publication->getDescription();
				$myPublication->expirationDate = $publication->getExpirationDate();
				$myPublication->category = $publication->getCategory();
				$myPublication->subcategoryId = $publication->getSubcategoryId();
				$myPublication->views = $publication->getViews();
				$myPublication->processStateId = $publication->getProcessStateId();
				$myPublication->objectId = $publication->getObjectId();
				$myPublication->quantity = $publication->getQuantity();
				if($myPublication->type == 1){
					$myPublication->processStateIdOffer = $publication->getProcessStateIdOffer();
					$myPublication->offerTypeId = $publication->getOfferTypeId();
					$myPublication->quantityUsersToPaused = $publication->getQuantityUsersToPaused();				
				}
				$return["data"][$key] = $myPublication;
			 } 
		}
		echo json_encode($return);
	}
}