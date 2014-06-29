<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Offer extends REST_Controller {

	public function index_get(){

		//checkIsLoggedIn($this);
		
		$id = $this->get("publicationId"); 
		$offers = $id ? CI_Offer::getById($id) : CI_Offer::getCurrentOffers();

		$status = 404;
		$return["result"] = "NOOK";
		if($offers){
			$status = 200;
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($offers as $key => $offer) {
				$myOffer = CI_Offer::getData($offer);
				$return["data"][$key] = $myOffer;
			 } 
		}
        $this->response($return, $status);
	}


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

		}else{

			$offer = CI_Offer::getDataFromArray($arrOptions);
		}

		$arrInfo['user'] = $arrOptions['user'];
		$arrInfo['type'] = $arrOptions['type'];
		$arrInfo['offer'] = $offer;
		$id = CI_Offer::save($arrInfo);

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
			if(CI_Offer::delete($offer)){
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
			if(CI_Offer::pause($offer)){
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
			$arrOptions['offer'] = $offer;
			
			if(CI_Offer::setAsFavorite($arrOptions)){
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
			$arrOptions['offer'] = $offer;
			
			if(CI_Offer::deleteFromFavorites($arrOptions)){
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
