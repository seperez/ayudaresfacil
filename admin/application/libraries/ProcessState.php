<?php

class CI_ProcessState {
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
		$phoneType->id = (isset($row->category_id)) ? $row->category_id : 0;
		$phoneType->description = (isset($row->description)) ? $row->description : '';
		return $phoneType;
	}
	
	public static function getProcessStates()
	{
		$CI = & get_instance();
		$CI->load->model('processState_model');
		$results = $CI->processState_model->getProcessStates();
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
		$CI->load->model('processState_model');
		$results = $CI->processState_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
