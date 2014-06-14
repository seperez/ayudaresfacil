<?php

class CI_CommonState {
	private $id;
	private $description;
	private $comments;

	public function getId() {return $this->id;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getComments(){return $this->comments;}
	public function setComments($comments){$this->comments = $comments;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->description = $this->description;
		$object->comments = $this->comments;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$phoneType = new self;
		$phoneType->id = (isset($row->category_id)) ? $row->category_id : 0;
		$phoneType->description = (isset($row->description)) ? $row->description : '';
		$phoneType->comments = (isset($row->comments)) ? $row->comments : '';
		return $phoneType;
	}
	
	public static function getCommonStates()
	{
		$CI = & get_instance();
		$CI->load->model('common_state_model');
		$results = $CI->common_state_model->getCommonStates();
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
		$CI->load->model('common_state_model');
		$results = $CI->common_state_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
