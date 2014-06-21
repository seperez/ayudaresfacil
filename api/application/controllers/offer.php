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

	//http://localhost/ayudaresfacil/api/offer/save?publicationId=15&userId=2&publicationTypeId=1&creationDate=2014-06-01&title=Un%20mJOJOJOif&description=alala&expirationDate=2014-09-09&categoryId=1&subcategoryId=1&views=12&processStateId=V&objectId=1&quantity=1&processStateIdOffer=V&offerTypeId=1&quantityUsersToPaused=2
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
		if($offer->save($arrInfo)){
			$return["result"] = "OK";
			
			$myOffer = new stdClass();
			$myOffer->id = $offer->getId();
			$myOffer->title = $offer->getTitle();
			$myOffer->description = $offer->getDescription();
			$myOffer->category = $offer->getCategory();
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

			//$my = CI_Offer::getData($myOffer);

			$return["data"] = $myOffer;
		}else{
			$return["result"] = "NOOK";
		}
		echo json_encode($return);
	}

}
