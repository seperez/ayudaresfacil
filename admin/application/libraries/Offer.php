<?php

class CI_Offer extends CI_Publication {
	private $processStateOffer;
	private $type;
	private $quantityUsersToPaused;

	public function getProcessStateOffer(){return $this->processStateOffer;}

	public function getType(){return $this->type;}

	public function getQuantityUsersToPaused(){return $this->quantityUsersToPaused;}
	public function setQuantityUsersToPaused($quantityUsersToPaused){$this->quantityUsersToPaused = $quantityUsersToPaused;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */
	protected function getData(){
		$object = parent::getData($row);
		$object->processStateOffer = $this->processStateOffer;
		$object->type = $this->type;
		$object->quantityUsersToPaused = $this->quantityUsersToPaused;
		return $object;
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

	/*
	public static function getRequests($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getRequests($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getOffers($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getOffers($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getRequestsById(){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getRequestsById();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getById($publicationId){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getById($publicationId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}

	public function save(){
		$return = TRUE;
		$CI =& get_instance();
		$CI->load->model('publication_model');
		if(isset($this->publicationId) && $this->publicationId > 0)
			$CI->publication_model->update($this->getData());
		else{
			$this->id = $CI->publication_model->create($this->getData());
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}

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