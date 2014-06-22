<?php

class CI_Publication {
	protected $id;
	protected $title;
	protected $description;
	protected $category;
	protected $subcategory;
	protected $object;
	protected $quantity;
	protected $views;
	protected $processState;
	protected $creationDate;
	protected $expirationDate;

	public function getId() {return $this->id;}
	
	public function getTitle(){return $this->title;}
	public function setTitle($title){$this->title = $title;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getCategory(){return $this->category;}
	public function setCategory($category){$this->category = CI_Category::getById($category);}

	public function getSubcategory(){return $this->subcategory;}
	public function setSubcategory($subcategory){$this->subcategory = CI_Subcategory::getById($subcategory);}
	
	public function getObject(){return $this->object;}
	public function setObject($object){$this->object = CI_Object::getById($object);}

	public function getQuantity(){return $this->quantity;}
	public function setQuantity($quantity){$this->quantity = $quantity;}

	public function getViews(){return $this->views;}
	public function setViews($views){$this->views = $views;}

	public function getProcessState(){return $this->processState;}
	public function setProcessState($processState){$this->processState = CI_ProcessState::getById($processState);}

	public function getCreationDate(){return $this->creationDate;}
	public function setCreationDate($creationDate){$this->creationDate = $creationDate;}
	
	public function getExpirationDate(){return $this->expirationDate;}
	public function setExpirationDate($expirationDate){$this->expirationDate = $expirationDate;}
	
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	*/	

	protected function getDataFromArray($options){
		$publication = new CI_Offer();
		if ($options["publicationId"] > 0) {
			$publication->id = $options["publicationId"];
		}
		$publication->title = $options["title"];
		$publication->description = $options["description"];
		$publication->category = CI_Category::getById($options["category"]);
		$publication->subcategory = CI_Subcategory::getById($options["subcategory"]);
		$publication->object = CI_Object::getById($options["object"]);
		$publication->quantity = $options["quantity"];
		$publication->views = $options["views"];
		$publication->processState = CI_ProcessState::getById($options["processState"]);
		$publication->creationDate = $options["creationDate"];
		$publication->expirationDate = $options["expirationDate"];
		return $publication;
	}

	protected function getData($options){
		$publication = new stdClass();
		$publication->id = $options->id;
		$publication->title = $options->title;
		$publication->description = $options->description;
		$publication->category = CI_Category::getData($options->category);
		$publication->subcategory = CI_Subcategory::getData($options->subcategory);
		$publication->object = CI_Object::getData($options->object);
		$publication->quantity = $options->quantity;
		$publication->views = $options->views;
		$publication->processState = CI_ProcessState::getData($options->processState);
		$publication->creationDate = $options->creationDate;
		$publication->expirationDate = $options->expirationDate;
		return $publication;
	}

	protected static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publication = new CI_Offer();
		$publication->id = (isset($row->publication_id)) ? $row->publication_id : 0;
		$publication->title = (isset($row->title)) ? $row->title : '';
		$publication->description = (isset($row->description)) ? $row->description : '';
		$publication->category = (isset($row->category_id)) ? CI_Category::getById($row->category_id) : '';
		$publication->subcategory = (isset($row->subcategory_id)) ? CI_Subcategory::getById($row->subcategory_id) : '';
		$publication->object = (isset($row->object_id)) ? CI_Object::getById($row->object_id) : '';
		$publication->quantity = (isset($row->quantity)) ? $row->quantity : '';
		$publication->views = (isset($row->views)) ? $row->views : '';
		$publication->processState = (isset($row->process_state_id)) ? CI_ProcessState::getById($row->process_state_id) : '';
		$publication->creationDate = (isset($row->creation_date)) ? $row->creation_date : '';
		$publication->expirationDate = (isset($row->expiration_date)) ? $row->expiration_date : '';
		return $publication;
	}

	public function save($user, $type){
		$return = TRUE;
		$CI = & get_instance();
		$CI->load->model('publication_model');
		if(isset($this->id) && $this->id > 0)
			$CI->publication_model->update($this->getData($this));
		else{
			$this->id = $CI->publication_model->create($this->getData($this));
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}

	public function setAsFavorite($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');

		//**
		//TODO: CHEQUEAR QUE EL FAVORITO PARA ESTE USUARIO Y ESTA PUBLICACION YA NO EXISTA.
		//**

		$data = array (
			"userId"=>$userId, 
			"publicationId" => $this->getId()
		);
		return $CI->publication_model->setAsFavorite($data);
	}

	public function deleteFromFavorites($userId){
		$CI =& get_instance();
		$CI->load->model('publication_model');	
		$data = array (
			"userId"=>$userId, 
			"publicationId" => $this->getId()
		);
		return $CI->publication_model->deleteFromFavorites($data);
	}
}