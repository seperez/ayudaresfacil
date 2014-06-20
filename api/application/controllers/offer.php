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

	public function save(){

		$arrOptions['publicationId'] = ($this->input->post('publicationId') > 0) ? $this->input->post('publicationId') : 0;
		$arrOptions['user'] = $this->input->post('userId');
		$arrOptions['type'] = $this->input->post('publicationTypeId');
		$arrOptions['creationDate'] = $this->input->post('creationDate');
		$arrOptions['title'] = $this->input->post('title');
		$arrOptions['description'] = $this->input->post('description');
		$arrOptions['expirationDate'] = $this->input->post('expirationDate');
		$arrOptions['category'] = $this->input->post('categoryId');
		$arrOptions['subcategory'] = $this->input->post('subcategoryId');
		$arrOptions['views'] = $this->input->post('views');
		$arrOptions['processState'] = $this->input->post('processStateId');
		$arrOptions['object'] = $this->input->post('objectId');
		$arrOptions['quantity'] = $this->input->post('quantity');
		$arrOptions['processStateIdOffer'] = $this->input->post('processStateIdOffer');
		$arrOptions['offerTypeId'] = $this->input->post('offerTypeId');
		$arrOptions['quantityUsersToPaused'] = $this->input->post('quantityUsersToPaused');

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

		if($offer->save($arrInfo)){
			$category = $offer->getCategory();
			$return["result"] = "OK";

			$myOffer = new stdClass();
			$myOffer->id = $offer->getId();
			$myOffer->title = $offer->getTitle();
			$myOffer->description = $offer->getDescription();
			$myOffer->category = CI_Category::getData($category);
			$myOffer->subcategory = $offer->getSubcategory();
			$myOffer->object = $offer->getObject();
			$myOffer->quantity = $offer->getQuantity();
			$myOffer->views = $offer->getViews();
			$myOffer->processState = $offer->getProcessState();
			$myOffer->creationDate = $offer->getCreationDate();
			$myOffer->expirationDate = $offer->getExpirationDate();
			$myOffer->processStateOffer = $offer->getProcessStateOffer();
			$myOffer->type = $offer->getType();
			$myOffer->quantityUsersToPaused = $offer->getQuantityUsersToPaused();

			$return["data"] = $myOffer;
		}else{
			$return["result"] = "NOOK";
		}
		echo json_encode($return);
	}

}
