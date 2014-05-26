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

	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->description = $this->description;
		$object->createdDate = $this->createdDate;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$user = new self;
		$user->id = (isset($row->object_id)) ? $row->object_id : 0;
		$user->description = (isset($row->description)) ? $row->description : '';
		$user->createdDate = (isset($row->created_date)) ? $row->created_date : '';
		return $user;
	}
	
	public static function getObjects()
	{
		$CI = & get_instance();
		$CI->load->model('object_model');
		$results = $CI->object_model->getObjects();
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
		$CI->load->model('object_model');
		$results = $CI->object_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
