<?php

class CI_City {
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
		$city = new self;
		$city->id = (isset($row->city_id)) ? $row->city_id : 0;
		$city->description = (isset($row->description)) ? $row->description : '';
		return $city;
	}
	
	public static function getCitiesByDepartmentId($id)
	{
		$CI = & get_instance();
		$CI->load->model('city_model');
		$results = $CI->city_model->getCitiesByDepartmentId($id);
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
		$CI->load->model('city_model');
		$results = $CI->city_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
