<?php

class CI_Department {
	private $id;
	private $description;
	private $cities;

	public function getId() {return $this->id;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getCities(){return $this->cities;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */
	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->description = $this->description;
		$object->cities = $this->cities;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$department = new self;
		$department->id = (isset($row->department_id)) ? $row->department_id : 0;
		$department->description = (isset($row->description)) ? $row->description : '';
		$department->cities = CI_City::getCitiesByDepartmentId ($department->id);
		return $department;
	}
	
	public static function getDepartmentsByProvinceId($id)
	{
		$CI = & get_instance();
		$CI->load->model('department_model');
		$results = $CI->department_model->getDepartmentsByProvinceId($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}
	
	public static function getDepartmentByCityId($id)
	{
		$CI = & get_instance();
		$CI->load->model('department_model');
		$results = $CI->department_model->getDepartmentByCityId($id);
		$return = array();
		if(!empty($results)){
			$return = self::getInstance($results[0]);
		}
		return $return;
	}
	
	public static function getById($id)
	{
		$CI = & get_instance();
		$CI->load->model('department_model');
		$results = $CI->department_model->getById($id);
		$return = array();
		if(!empty($results)){
			$return = self::getInstance($result[0]);
		}
		return $return;
	}
}
