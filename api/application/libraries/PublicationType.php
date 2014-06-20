<?php

class CI_PublicationType {
	private $id;
	private $name;
	private $description;

	public function getId() {return $this->id;}
	
	public function getName(){return $this->name;}
	public function setName($name){$this->name = $name;}

	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	public function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->name = $this->name;
		$object->description = $this->description;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$publicationType = new self;
		$publicationType->id = (isset($row->publication_type_id)) ? $row->publication_type_id : 0;
		$publicationType->name = (isset($row->name)) ? $row->name : '';
		$publicationType->description = (isset($row->description)) ? $row->description : '';
		return $publicationType;
	}
	
	public static function getPublicationTypes()
	{
		$CI = & get_instance();
		$CI->load->model('publication_type_model');
		$results = $CI->publication_type_model->getPublicationTypes();
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
		$CI = & get_instance();
		$CI->load->model('publication_type_model');
		$results = $CI->publication_type_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
