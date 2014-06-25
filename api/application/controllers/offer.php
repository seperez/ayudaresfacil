<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 	
	}

	public function index(){}

	public function getById(){
		$id = $this->input->get('publicationId');
		$return["result"] = "NOOK";
		$offer = CI_Offer::getById($id);	

		if($offer){
			$return["result"] = "OK";
			$myOffer = CI_Offer::getData($offer);	
			$return["data"] = $myOffer;
		}
		echo json_encode($return);
	}

	public function getByUser(){
		$userId = $this->input->get('userId');
		$return["result"] = "NOOK";
		$offers = CI_Offer::getByUser($userId);	

		if($offers){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($offers as $key => $offer) {
				$myOffer = CI_Offer::getData($offer);
				$return["data"][$key] = $myOffer;
			 } 
		}
		echo json_encode($return);
	}

	public function save(){
		$arrOptions['publicationId'] = ($this->input->get('publicationId') > 0) ? $this->input->get('publicationId') : 0;
		$arrOptions['user'] = $this->input->get('userId');
		$arrOptions['type'] = $this->input->get('publicationTypeId');
		$arrOptions['creationDate'] = $this->input->get('creationDate');
		$arrOptions['title'] = $this->input->get('title');
		$arrOptions['description'] = $this->input->get('description');
		$arrOptions['expirationDate'] = $this->input->get('expirationDate');
		$arrOptions['category'] = $this->input->get('categoryId');
		$arrOptions['subcategory'] = $this->input->get('subcategoryId');
		$arrOptions['views'] = $this->input->get('views');
		$arrOptions['processState'] = $this->input->get('processStateId');
		$arrOptions['object'] = $this->input->get('objectId');
		$arrOptions['quantity'] = $this->input->get('quantity');
		$arrOptions['processStateIdOffer'] = $this->input->get('processStateIdOffer');
		$arrOptions['offerTypeId'] = $this->input->get('offerTypeId');
		$arrOptions['quantityUsersToPaused'] = $this->input->get('quantityUsersToPaused');

		if($arrOptions['publicationId'] > 0){
			$offer = CI_Offer::getById($arrOptions['publicationId']);

			$offer->setTitle($arrOptions['title']);
			$offer->setDescription($arrOptions['description']);
			$offer->setCategory($arrOptions['category']);
			$offer->setSubcategory($arrOptions['subcategory']);
			$offer->setObject($arrOptions['object']);
			$offer->setQuantity($arrOptions['quantity']);
			$offer->setViews($arrOptions['views']);
			$offer->setProcessState($arrOptions['processState']);
			$offer->setCreationDate($arrOptions['creationDate']);
			$offer->setExpirationDate($arrOptions['expirationDate']);
			$offer->setProcessStateOffer($arrOptions['processStateIdOffer']);
			$offer->setType($arrOptions['offerTypeId']);
			$offer->setQuantityUsersToPaused($arrOptions['quantityUsersToPaused']);

		}else{
			$offer = CI_Offer::getDataFromArray($arrOptions);
		}

		$arrInfo['user'] = $arrOptions['user'];
		$arrInfo['type'] = $arrOptions['type'];
		$id = $offer->save($arrInfo);

		if($id === NULL){
			$return["result"] = "NOOK";
		}else{
			$return["result"] = "OK";			
			$return["publicationId"] = $id;
			$myOffer = CI_Offer::getData($offer);	
			$return["data"] = $myOffer;
		}
		echo json_encode($return);
	}

	public function delete(){
		$error = $info = $success = "";
		$return["result"] = "NOOK";
		$publicationId = $this->input->get('publicationId');

		if($publicationId > 0){
			$offer = CI_Offer::getById($publicationId);
			if($offer->delete()){
				$return["result"] = "OK";
			}
		}
		echo json_encode($return);	
	}

	public function getCurrentOffers(){
		$return["result"] = "NOOK";
		$offers = CI_Offer::getCurrentOffers();

		if($offers){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($offers as $key => $offer) {
				$myOffer = CI_Offer::getData($offer);
				$return["data"][$key] = $myOffer;
			 } 
		}
		echo json_encode($return);
	}

	public function pause(){
		$error = $info = $success = "";
		$return["result"] = "NOOK";
		$publicationId = $this->input->get('publicationId');

		if($publicationId > 0){
			$offer = CI_Offer::getById($publicationId);
			if($offer->pause()){
				$return["result"] = "OK";
			}
		}
		echo json_encode($return);	
	}

	public function setAsFavorite(){
		$error = $info = $success = "";
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = $this->input->get('publicationId');
		$arrOptions['userId'] = $this->input->get('userId');

		if($arrOptions['publicationId'] > 0){
			$offer = CI_Offer::getById($arrOptions['publicationId']);
			if($offer->setAsFavorite($arrOptions['userId'])){
				$return["result"] = "OK";
			}
		}
		echo json_encode($return);	
	}

	public function deleteFromFavorites(){
		$error = $info = $success = "";
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = $this->input->get('publicationId');
		$arrOptions['userId'] = $this->input->get('userId');

		if($arrOptions['publicationId'] > 0){
			$offer = CI_Offer::getById($arrOptions['publicationId']);
			if($offer->deleteFromFavorites($arrOptions['userId'])){
				$return["result"] = "OK";
			}
		}
		echo json_encode($return);	
	}

	public function getFavoritesByUser(){
		$userId = $this->input->get('userId');
		$return["result"] = "NOOK";
		$offers = CI_Offer::getFavoritesByUser($userId);

		if($offers){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($offers as $key => $offer) {
				$myOffer = CI_Offer::getData($offer);
				$return["data"][$key] = $myOffer;
			 } 
		}
		echo json_encode($return);
	}
}
