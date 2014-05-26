<?php

class CI_Publication {
	private $publicationId;
	private $user;
	private $type;
	private $creationDate;
	private $title;
	private $description;
	private $expirationDate;
	private $category;
	private $subcategory;
	private $views;
	private $processState;
	private $objectId;
	private $quantity;
	private $processStateIdOffer;
	private $offerTypeId;
	private $quantityUsersToPaused;

	public function getPublicationId() {return $this->publicationId;}

	public function getUser() {return $this->user;}
	public function setUser($user){$this->user = CI_User::getById($user);}
	
	public function getType(){return $this->type;}
	public function setType($type){$this->type = CI_PublicationType::getById($type);}

	public function getCreationDate(){return $this->creationDate;}
	public function setCreationDate($creationDate){$this->creationDate = $creationDate;}
	
	public function getTitle(){return $this->title;}
	public function setTitle($title){$this->title = $title;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}
	
	public function getExpirationDate(){return $this->expirationDate;}
	public function setExpirationDate($expirationDate){$this->expirationDate = $expirationDate;}

	public function getCategory(){return $this->category;}
	public function setCategory($category){$this->category = CI_Category::getById($category);}

	public function getSubcategory(){return $this->subcategory;}
	public function setSubcategory($subcategory){$this->subcategory = CI_Subcategory::getById($subcategory);}

	public function getViews(){return $this->views;}
	public function setViews($views){$this->views = $views;}

	public function getProcessState(){return $this->processState;}
	public function setProcessState($processState){$this->processState = CI_ProcessState::getById($processState);}

	public function getObject(){return $this->object;}
	public function setObject($object){$this->object = $object;}

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
		$object->user = $this->user;
		$object->type =  $this->type;
		$object->creationDate = $this->creationDate;
		$object->title = $this->title;
		$object->description = $this->description;
		$object->expirationDate = $this->expirationDate;
		$object->category = $this->category;
		$object->subcategory = $this->subcategory;
		$object->views = $this->views;
		$object->processState = $this->processState;
		$object->object = $this->object;
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
		$publication->user = (isset($row->user_id)) ? CI_User::getById($row->user_id) : '';
		$publication->type = (isset($row->publication_type_id)) ? CI_PublicationType::getById($row->publication_type_id) : '';
		$publication->creationDate = (isset($row->creation_date)) ? $row->creation_date : '';
		$publication->title = (isset($row->title)) ? $row->title : '';
		$publication->description = (isset($row->description)) ? $row->description : '';
		$publication->expirationDate = (isset($row->expiration_date)) ? $row->expiration_date : '';
		$publication->category = (isset($row->category_id)) ? CI_Category::getById($row->category_id) : '';
		$publication->subcategory = (isset($row->subcategory_id)) ? CI_Subcategory::getById($row->subcategory_id) : '';
		$publication->views = (isset($row->views)) ? $row->views : '';
		$publication->processState = (isset($row->process_state_id)) ? CI_ProcessState::getById($row->process_state_id) : '';
		$publication->object = (isset($row->object_id)) ? CI_Object::getById($row->object_id) : '';
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
	}
}