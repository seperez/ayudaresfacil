<?php

class CI_Offer extends CI_Publication {
	private $processStateOffer;
	private $type;
	private $quantityUsersToPaused;

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

	public function getData($object){
		$offer = parent::getData($object);
		$offer->processStateOffer = CI_ProcessState::getData($object->processStateOffer);
		$offer->type = CI_OfferType::getData($object->type);
		$offer->quantityUsersToPaused = $object->quantityUsersToPaused;
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
			$return = self::getInstance($results[0]);
		}
		return $return;
	}

	public static function getOffers(){
		$CI =& get_instance();
		$CI->load->model('offer_model');
		$results = $CI->offer_model->getOffers();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
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
	
	public function save($user, $type){
		$return = TRUE;
		$CI =& get_instance();
		$CI->load->model('offer_model');
		if(isset($this->id) && $this->id > 0)
			$CI->offer_model->update($this->getData($this));
		else{
			$this->id = $CI->offer_model->create($this->getData($this), $user, $type);
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}
/*
	public function delete(){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		return $CI->publication_model->delete($this->publicationId);
	}

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