<?php

class CI_Publication {
	private $id;
	private $user_id;
	private $creation_date;
	private $tittle;
	private $description;
	private $expiration_date;
	private $category_id;
	private $subcategory_id;
	private $views;

	public function getId() {return $this->id;}

	public function getUser_id() {return $this->user_id;}
	public function setUser_id($user_id){$this->user_id = $user_id;}
	
	public function getCreation_date(){return $this->creation_date;}
	public function setCreation_date($creation_date){$this->creation_date = $creation_date;}
	
	public function getTittle(){return $this->tittle;}
	public function setTittle($tittle){$this->tittle = $tittle;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}
	
	public function getExpiration_date(){return $this->expiration_date;}
	public function setExpiration_date($expiration_date){$this->expiration_date = $expiration_date;}

	public function getCategory_id(){return $this->category_id;}
	public function setCategory_id($category_id){$this->category_id = $category_id;}

	public function getSubcategory_id(){return $this->subcategory_id;}
	public function setSubcategory_id($subcategory_id){$this->subcategory_id = $subcategory_id;}

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
		$object->user_id = $this->user_id;
		$object->creation_date = $this->creation_date;
		$object->tittle = $this->tittle;
		$object->description = $this->description;
		$object->expiration_date = $this->expiration_date;
		$object->category_id = $this->category_id;
		$object->subcategory_id = $this->subcategory_id;
		$object->views = $this->views;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publication = new self;
		$publication->id = (isset($row->publication_id)) ? $row->publication_id : 0;
		$publication->user_id = (isset($row->user_id)) ? $row->user_id : '';
		$publication->creation_date = (isset($row->creation_date)) ? $row->creation_date : '';
		$publication->tittle = (isset($row->tittle)) ? $row->tittle : '';
		$publication->description = (isset($row->description)) ? $row->description : '';
		$publication->expiration_date = (isset($row->expiration_date)) ? $row->expiration_date : '';
		$publication->category_id = (isset($row->category_id)) ? $row->category_id : '';
		$publication->subcategory_id = (isset($row->subcategory_id)) ? $row->subcategory_id : '';
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
		if(isset($this->id) && $this->id > 0)
			$CI->publication_model->update($this->getData());
		else{
			$this->id = $CI->publication_model->create($this->getData());
			if($this->id === null)
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