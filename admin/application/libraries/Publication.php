<?php

class CI_Publication {
	private $id;
	private $userId;
	private $creationDate;
	private $tittle;
	private $description;
	private $expirationDate;
	private $categoryId;
	private $subcategoryId;
	private $views;

	public function getId() {return $this->id;}

	public function getUserId() {return $this->userId;}
	public function setUserId($userId){$this->userId = $userId;}
	
	public function getCreationDate(){return $this->creationDate;}
	public function setCreationDate($creationDate){$this->creationDate = $creationDate;}
	
	public function getTittle(){return $this->tittle;}
	public function setTittle($tittle){$this->tittle = $tittle;}
	
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


	/**
	 * Devuelve la informacion cargada del objeto 
	 * 	
	 * Uso interno
	 *  
	 * @return object
	 */

	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->userId = $this->userId;
		$object->creationDate = $this->creationDate;
		$object->tittle = $this->tittle;
		$object->description = $this->description;
		$object->expirationDate = $this->expirationDate;
		$object->categoryId = $this->categoryId;
		$object->subcategoryId = $this->subcategoryId;
		$object->views = $this->views;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publication = new self;
		$publication->id = (isset($row->publication_id)) ? $row->publication_id : 0;
		$publication->userId = (isset($row->user_id)) ? $row->user_id : '';
		$publication->creationDate = (isset($row->creation_date)) ? $row->creation_date : '';
		$publication->tittle = (isset($row->tittle)) ? $row->tittle : '';
		$publication->description = (isset($row->description)) ? $row->description : '';
		$publication->expirationDate = (isset($row->expiration_date)) ? $row->expiration_date : '';
		$publication->categoryId = (isset($row->category_id)) ? $row->category_id : '';
		$publication->subcategoryId = (isset($row->subcategory_id)) ? $row->subcategory_id : '';
		$publication->views = (isset($row->views)) ? $row->views : '';
		return $publication;
	}
	
	public static function getPublications()
	{
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$results = $CI->publication_model->getPublications();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}
	
	public static function getById($id)
	{
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
	
	public function save(){
		$return = TRUE;
		$CI =& get_instance();
		$CI->load->model('publication_model');
		$this->id = $CI->publication_model->create($this->getData());
		if($this->id === null){
			$return = FALSE;
		}
		return $return;
	}
	
	public function delete()
	{
		$CI =& get_instance();
		$CI->load->model('publication_model');
		return $CI->publication_model->delete($this->id);
	}


}