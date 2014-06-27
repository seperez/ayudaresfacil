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

	public function getData($options){
		$object = new stdClass();
		$object->id = $options->id;
		$object->description = $options->description;
		$object->comments = $options->comments;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$commonState = new CI_CommonState;
		$commonState->id = (isset($row->common_state_id)) ? $row->common_state_id : 0;
		$commonState->description = (isset($row->description)) ? $row->description : '';
		$commonState->comments = (isset($row->comments)) ? $row->comments : '';
		return $commonState;
	}
	
	public static function getCommonStates()
	{
		$CI = & get_instance();
		$CI->load->model('common_state_model');
		$results = $CI->common_state_model->getCommonStates();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = CI_CommonState::getInstance($result);
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
				$return = CI_CommonState::getInstance($result);
			}
		}
		return $return;
	}
}
