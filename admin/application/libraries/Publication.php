<?php

class CI_Publication {
	private $publicationId;
	private $userId;
	private $publicationTypeId;
	private $creationDate;
	private $title;
	private $description;
	private $expirationDate;
	private $categoryId;
	private $subcategoryId;
	private $views;
	private $processStateId;
	private $objectId;
	private $quantity;
	private $processStateIdOffer;
	private $offerTypeId;
	private $quantityUsersToPaused;

	public function getPublicationId() {return $this->publicationId;}

	public function getUserId() {return $this->userId;}
	public function setUserId($userId){$this->userId = $userId;}
	
	public function getPublicationTypeId(){return $this->publicationTypeId;}
	public function setPublicationTypeId($publicationTypeId){$this->publicationTypeId = $publicationTypeId;}

	public function getCreationDate(){return $this->creationDate;}
	public function setCreationDate($creationDate){$this->creationDate = $creationDate;}
	
	public function getTitle(){return $this->title;}
	public function setTitle($title){$this->title = $title;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}
	
	public function getExpirationDate(){return $this->expirationDate;}
	public function setExpirationDate($expirationDate){$this->expirationDate = $expirationDate;}

	public function getCategoryId(){return $this->categoryId;}
	public function setCategoryId($categoryId){$this->categoryId = $categoryId;}

	public function getSubcategoryId(){return $this->subcategoryId;}
	public function setSubcategoryId($subcategoryId){$this->subcategoryId = $subcategoryId;}

	public function getViews(){return $this->views;}
	public function setViews($views){$this->views = $views;}

	public function getProcessStateId(){return $this->processStateId;}
	public function setProcessStateId($processStateId){$this->processStateId = $processStateId;}

	public function getObjectId(){return $this->objectId;}
	public function setObjectId($objectId){$this->objectId = $objectId;}

	public function getQuantity(){return $this->quantity;}
	public function setQuantity($quantity){$this->quantity = $quantity;}

	public function getProcessStateIdOffer(){return $this->processStateIdOffer;}
	public function setProcessStateIdOffer($processStateIdOffer){$this->processStateIdOffer = $processStateIdOffer;}

	public function getOfferTypeId(){return $this->offerTypeId;}
	public function setOfferTypeId($offerTypeId){$this->offerTypeId = $offerTypeId;}

	public function getQuantityUsersToPaused(){return $this->quantityUsersToPaused;}
	public function setQuantityUsersToPaused($quantityUsersToPaused){$this->quantityUsersToPaused = $quantityUsersToPaused;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * 	
	 * Uso interno
	 *  
	 * @return object
	 */

	private function getData(){
		$object = new stdClass();
		$object->publicationId = $this->publicationId;
		$object->userId = $this->userId;
		$object->publicationTypeId = $this->publicationTypeId;
		$object->creationDate = $this->creationDate;
		$object->title = $this->title;
		$object->description = $this->description;
		$object->expirationDate = $this->expirationDate;
		$object->categoryId = $this->categoryId;
		$object->subcategoryId = $this->subcategoryId;
		$object->views = $this->views;
		$object->processStateId = $this->processStateId;
		$object->objectId = $this->objectId;
		$object->quantity = $this->quantity;
		$object->processStateIdOffer = $this->processStateIdOffer;
		$object->offerTypeId = $this->offerTypeId;
		$object->quantityUsersToPaused = $this->quantityUsersToPaused;
		return $object;
	}

	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publication = new self;
		$publication->publicationId = (isset($row->publication_id)) ? $row->publication_id : 0;
		$publication->userId = (isset($row->user_id)) ? $row->user_id : '';
		$publication->publicationTypeId = (isset($row->publication_type_id)) ? $row->publication_type_id : '';
		$publication->creationDate = (isset($row->creation_date)) ? $row->creation_date : '';
		$publication->title = (isset($row->title)) ? $row->title : '';
		$publication->description = (isset($row->description)) ? $row->description : '';
		$publication->expirationDate = (isset($row->expiration_date)) ? $row->expiration_date : '';
		$publication->categoryId = (isset($row->category_id)) ? $row->category_id : '';
		$publication->subcategoryId = (isset($row->subcategory_id)) ? $row->subcategory_id : '';
		$publication->views = (isset($row->views)) ? $row->views : '';
		$publication->processStateId = (isset($row->process_state_id)) ? $row->process_state_id : '';
		$publication->objectId = (isset($row->object_id)) ? $row->object_id : '';
		$publication->quantity = (isset($row->quantity)) ? $row->quantity : '';
		$publication->processStateIdOffer = (isset($row->process_state_offer)) ? $row->process_state_offer : '';
		$publication->offerTypeId = (isset($row->offer_type_id)) ? $row->offer_type_id : '';
		$publication->quantityUsersToPaused = (isset($row->quantity_users_to_paused)) ? $row->quantity_users_to_paused : '';
		return $publication;
	}

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
}