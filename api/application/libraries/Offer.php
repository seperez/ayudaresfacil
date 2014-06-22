<?php

class CI_Offer extends CI_Publication {
	protected $processStateOffer;
	protected $type;
	protected $quantityUsersToPaused;
	
	public function getProcessStateOffer(){return $this->processStateOffer;}
	public function setProcessStateOffer($processStateOffer){$this->processStateOffer = CI_ProcessState::getById($processStateOffer);}

	public function getType(){return $this->type;}
	public function setType($type){$this->type = CI_OfferType::getById($type);}

	public function getQuantityUsersToPaused(){return $this->quantityUsersToPaused;}
	public function setQuantityUsersToPaused($quantityUsersToPaused){$this->quantityUsersToPaused = $quantityUsersToPaused;}
	
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	public function getDataFromArray($options){
		$offer = parent::getDataFromArray($options);
		$offer->processStateOffer = CI_ProcessState::getById($options["processStateIdOffer"]);
		$offer->type = CI_OfferType::getById($options["offerTypeId"]);
		$offer->quantityUsersToPaused = $options["quantityUsersToPaused"];
		return $offer;
	}

	public function getData($options){
		$offer = parent::getData($options);
		$offer->processStateOffer = CI_ProcessState::getData($options->processStateOffer);
		$offer->type = CI_OfferType::getData($options->type);
		$offer->quantityUsersToPaused = $options->quantityUsersToPaused;
		return $offer;
	}

	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$offer = parent::getInstance($row);
		$offer->processStateOffer = CI_ProcessState::getById($row->process_state_offer);
		$offer->type = CI_OfferType::getById($row->offer_type_id);
		$offer->quantityUsersToPaused = (isset($row->quantity_users_to_paused)) ? $row->quantity_users_to_paused : '';
		
		return $offer;
	}

	public static function getById($id){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		$results = $CI->offer_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result){
				$return = CI_Offer::getInstance($result);
			}
		}
		return $return;
	}

	public static function getOffers(){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		$results = $CI->offer_model->getOffers();
		$return = array();
		if(!empty($results)){
			foreach($results as $result){
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getOffersByUserId($userId){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		$results = $CI->offer_model->getOffersByUserId($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getFavoritesByUserId($userId){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		$results = $CI->offer_model->getFavoritesByUserId($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}
	
	public function save($arrInfo){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		$id = $this->getId();
		if(isset($id) && $id > 0){
			$CI->offer_model->update(CI_Offer::getData($this));
		}else{
			$id = $CI->offer_model->create(CI_Offer::getData($this), $arrInfo);
		}
		return $id;
	}

	public function delete(){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		return $CI->offer_model->delete($this->id);
	}

	/*
	public function pauseOffer(){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		return $CI->publication_model->pauseOffer($this->publicationId);
	}

	public function addFavourite($options){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		return $CI->publication_model->addFavourite($options);
	}

	public static function getOffersFavourites($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getOffersFavourites($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}
	
	public static function getRequestsFavourites($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getRequestsFavourites($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}*/
}