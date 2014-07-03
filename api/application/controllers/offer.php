<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Offer extends REST_Controller {

	public function index_get(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";

		$id = $this->get("publicationId"); 
		$userId = $this->get("userId");
		
		if($id){
			$offers = CI_Offer::getById($id);	
		}elseif ($userId) {
			$offers = CI_Offer::getByUser($userId);	
		}else{
			$offers = CI_Offer::getCurrentOffers();
		}

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

	public function index_post(){
		
		checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = ($this->post('publicationId') > 0) ? $this->post('publicationId') : 0;
		$arrOptions['user'] = $this->post('userId');
		$arrOptions['type'] = $this->post('publicationTypeId');
		$arrOptions['creationDate'] = $this->post('creationDate');
		$arrOptions['title'] = $this->post('title');
		$arrOptions['description'] = $this->post('description');
		$arrOptions['expirationDate'] = $this->post('expirationDate');
		$arrOptions['category'] = $this->post('categoryId');
		$arrOptions['subcategory'] = $this->post('subcategoryId');
		$arrOptions['views'] = $this->post('views');
		$arrOptions['processState'] = $this->post('processStateId');
		$arrOptions['object'] = $this->post('objectId');
		$arrOptions['quantity'] = $this->post('quantity');
		$arrOptions['processStateIdOffer'] = $this->post('processStateIdOffer');
		$arrOptions['offerTypeId'] = $this->post('offerTypeId');
		$arrOptions['quantityUsersToPaused'] = $this->post('quantityUsersToPaused');

		if($arrOptions['publicationId'] > 0){
			$offer = CI_Offer::getById($arrOptions['publicationId']);
			if ($offer <> NULL) {
				$offer = CI_Offer::getDataFromArray($arrOptions);
			}						
		}else{
			$offer = CI_Offer::getDataFromArray($arrOptions);
		}

		if ($offer <> NULL) {
			$arrInfo['user'] = $arrOptions['user'];
			$arrInfo['type'] = $arrOptions['type'];
			$arrInfo['offer'] = $offer;

			$id = CI_Offer::save($arrInfo);

			if($id <> NULL){
				$status = 200;
				$return["result"] = "OK";
				$return["data"] = "";			
				$return["publicationId"] = $id;
				$myOffer = CI_Offer::getData($offer);	
				$return["data"] = $myOffer;
			}
		}
        $this->response($return, $status);
	}

	public function index_delete(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";
		$publicationId = ($this->delete('publicationId') > 0) ? $this->delete('publicationId') :0;

		if($publicationId > 0){
			$offer = CI_Offer::getById($publicationId);
			if(CI_Offer::delete($offer[0])){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		$this->response($return, $status);
	}

	public function pause_post(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";
		$publicationId = ($this->post('publicationId') > 0) ? $this->post('publicationId') :0;

		if($publicationId > 0){
			$offer = CI_Offer::getById($publicationId);
			if(CI_Offer::pause($offer[0])){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		$this->response($return, $status);
	}

	public function favorite_get(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";
 
		$userId = $this->get("userId");
		$offers = CI_Offer::getFavoritesByUser($userId);

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
	
	public function favorite_post(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = $this->post('publicationId');
		$arrOptions['userId'] = $this->post('userId');

		if($arrOptions['publicationId'] > 0){
			$offer = CI_Offer::getById($arrOptions['publicationId']);
			$arrOptions['offer'] = $offer[0];

			if(CI_Offer::setAsFavorite($arrOptions)){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		$this->response($return, $status);
	}

	public function favorite_delete(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = $this->delete('publicationId');
		$arrOptions['userId'] = $this->delete('userId');

		if($arrOptions['publicationId'] > 0){
			$offer = CI_Offer::getById($arrOptions['publicationId']);
			$arrOptions['offer'] = $offer[0];

			if(CI_Offer::deleteFromFavorites($arrOptions)){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		$this->response($return, $status);
	}

	public function state_get(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";
 
		$publicationId = $this->get("publicationId");
		$offers = CI_Offer::getById($publicationId);
		$state = " ";

		if($offers){
			$status = 200;
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($offers as $key => $offer) {
				$myOffer = CI_Offer::getData($offer);
				$state = $myOffer->processStateOffer;
				$return["data"][$key] = $state->id;
			 } 
		}
        $this->response($return, $status);
	}

	public function changestate_post(){
		
		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";       
		$publicationId = $this->post('publicationId');
		$state = $this->post('state');

		$arrOptions = "";
		
		if($publicationId > 0){
			$offers = CI_Offer::getById($publicationId);

			foreach ($offers as $key => $offer) {
				$myOffer = CI_Offer::getData($offer);
				$arrOptions["offer"] = $myOffer;
				$arrOptions["state"] = $state;
			 } 

			if(CI_Offer::changeState($arrOptions)){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		$this->response($return, $status);
	}

	public function type_get(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = $this->get('publicationId');

		if($arrOptions['publicationId'] > 0){
			$offers = CI_Offer::getById($arrOptions['publicationId']);
			
			if($offers){
				$status = 200;
				$return["result"] = "OK";
				$return["data"] = "";

				foreach ($offers as $key => $offer) {
					$myOffer = CI_Offer::getData($offer);
					$type = $myOffer->type;
					$return["data"][$key] = $type->id;
				 } 
			}
			$this->response($return, $status);
		}
	}	

	public function quantity_get(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = $this->get('publicationId');

		if($arrOptions['publicationId'] > 0){
			$offers = CI_Offer::getById($arrOptions['publicationId']);
			
			if($offers){
				$status = 200;
				$return["result"] = "OK";
				$return["data"] = "";

				foreach ($offers as $key => $offer) {
					$myOffer = CI_Offer::getData($offer);
					$type = $myOffer->quantityUsersToPaused;
					$return["data"][$key] = $type;
				 } 
			}
			$this->response($return, $status);
		}
	}
}
