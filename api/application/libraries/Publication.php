<?php

class CI_Publication {
	private $id;
	private $title;
	private $description;
	private $category;
	private $subcategory;
	private $object;
	private $quantity;
	private $views;
	private $processState;
	private $creationDate;
	private $expirationDate;
	private $image;

	public function getId() {return $this->id;}
	
	public function getTitle(){return $this->title;}
	public function setTitle($title){$this->title = $title;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getCategory(){
		$category = null;
		foreach ($this->category as $key => $categor){
			$myCategory = new stdClass();
			$myCategory->id = $categor->getId();
			$myCategory->description = $categor->getDescription();
			$myCategory->commonState = $categor->getCommonState();
			$category[$key] = $myCategory;
		}
		return $category;
	}
	public function setCategory($category){$this->category = CI_Category::getById($category);}

	public function getSubcategory(){
		$subcategory = null;
		foreach ($this->subcategory as $key => $subcategor){
			$mySubcategory = new stdClass();
			$mySubcategory->id = $subcategor->getId();
			$mySubcategory->category = $subcategor->getCategory();
			$mySubcategory->description = $subcategor->getDescription();
			$mySubcategory->commonState = $subcategor->getCommonState();
			$subcategory[$key] = $mySubcategory;
		}
		return $subcategory;
	}
	public function setSubcategory($subcategory){$this->subcategory = CI_Subcategory::getById($subcategory);}
	
	public function getObject(){
		$object = null;
		foreach ($this->object as $key => $objec){
			$myObject = new stdClass();
			$myObject->id = $objec->getId();
			$myObject->description = $objec->getDescription();
			$myObject->createdDate = $objec->getCreatedDate();
			$object[$key] = $myObject;
		}
		return $object;
	}
	public function setObject($object){$this->object = CI_Object::getById($object);}

	public function getQuantity(){return $this->quantity;}
	public function setQuantity($quantity){$this->quantity = $quantity;}

	public function getViews(){return $this->views;}
	public function setViews($views){$this->views = $views;}

	public function getProcessState(){
		$processState = null;
		foreach ($this->processState as $key => $processStat){
			$myProcessState = new stdClass();
			$myProcessState->id = $processStat->getId();
			$myProcessState->description = $processStat->getDescription();
			$processState[$key] = $myProcessState;
		}
		return $processState;
	}
	public function setProcessState($processState){$this->processState = CI_ProcessState::getById($processState);}

	public function getCreationDate(){return $this->creationDate;}
	public function setCreationDate($creationDate){$this->creationDate = $creationDate;}
	
	public function getExpirationDate(){return $this->expirationDate;}
	public function setExpirationDate($expirationDate){$this->expirationDate = $expirationDate;}
	
	public function getImage(){
		$image = null;
		foreach ($this->image as $key => $imag){
			$myImage = new stdClass();
			$myImage->id = $imag->getId();
			$myImage->path = $imag->getPath();
			$image[$key] = $myImage;
		}
		return $image;
	}
	public function setImage($image){$this->image = CI_Image::getById($image);}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	*/	

	protected function getDataFromArray($options){
		$publication = new stdClass();
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
		$publication->image = CI_Image::getById($options["image"]);
		return $publication;
	}

	protected function getData($options){
		$publication = new stdClass();
		if(isset($options->id)){
			$publication->id = $options->id;
		}
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
		$publication->image = CI_Image::getData($options->image);
		return $publication;
	}

	protected static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publication = new stdClass();
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
		$publication->image = (isset($row->image_id)) ? CI_Image::getById($row->image_id) : '';
		return $publication;
	}
}