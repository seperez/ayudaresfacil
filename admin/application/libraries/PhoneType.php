<?php

class CI_PhoneType {
	private $id;
	private $description;

	public function getId() {return $this->id;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */
	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->description = $this->description;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$phoneType = new self;
		$phoneType->id = (isset($row->type_phone_id)) ? $row->type_phone_id : 0;
		$phoneType->description = (isset($row->description)) ? $row->description : '';
		return $phoneType;
	}
	
	public static function getPhoneTypes()
	{
		$CI = & get_instance();
		$CI->load->model('phoneType_model');
		$results = $CI->phoneType_model->getPhoneTypes();
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
		$CI->load->model('phoneType_model');
		$results = $CI->phoneType_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
