<?php

class CI_Object {
	private $id;
	private $description;
	private $createdDate;

	public function getId() {return $this->id;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}
	
	public function getCreatedDate(){return $this->createdDate;}
	public function setCreatedDate($createdDate){$this->createdDate = $createdDate;}
	
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	public function getData($options){
		$object = new stdClass();
		$object->id = $options->id;
		$object->description = $options->description;
		$object->createdDate = $options->createdDate;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$object = new CI_Object();
		$object->id = (isset($row->object_id)) ? $row->object_id : 0;
		$object->description = (isset($row->description)) ? $row->description : '';
		$object->createdDate = (isset($row->created_date)) ? $row->created_date : '';
		return $object;
	}
	
	public static function getObjects()
	{
		$CI = & get_instance();
		$CI->load->model('object_model');
		$results = $CI->object_model->getObjects();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = CI_Object::getInstance($result);
			}
		}
		return $return;
	}

	public static function getById($id)
	{
		$CI = & get_instance();
		$CI->load->model('object_model');
		$results = $CI->object_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = CI_Object::getInstance($result);
			}
		}
		return $return;
	}
}
