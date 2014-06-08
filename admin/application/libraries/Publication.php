<?php

class CI_Publication {
	private $id;
	private $creationDate;
	private $title;
	private $description;
	private $expirationDate;
	private $category;
	private $subcategory;
	private $views;
	private $processState;
	private $object;
	private $quantity;

	public function getId() {return $this->id;}

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
	public function setObject($object){$this->object = CI_Object::getById($object);}

	public function getQuantity(){return $this->quantity;}
	public function setQuantity($quantity){$this->quantity = $quantity;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * 		
	 * Uso interno
	 *  
	 * @return object
	 */

	protected function getData(){
		$object = new stdClass();
		$object->id = $this->publicationId;
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
		return $object;
	}

	protected static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publication = new self;
		$publication->id = (isset($row->publication_id)) ? $row->publication_id : 0;
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
		return $publication;
	}

	public static function getById($id){
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}