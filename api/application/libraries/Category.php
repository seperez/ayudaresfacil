<?php

class CI_Category{
	private $id;
	private $description;
	private $commonState;

	public function getId(){return $this->id;}
	
	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getCommonState(){return $this->commonState;}
	public function setCommonState($commonState){$this->commonState = CI_CommonState::getById($commonState);}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	public function getData($options){
		$object = new stdClass();
		$object->id = $options->id;
		$object->description = $options->description;
		$object->commonState = CI_CommonState::getData($options->commonState);
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$category = new CI_Category();
		$category->id = (isset($row->category_id)) ? $row->category_id : 0;
		$category->description = (isset($row->description)) ? $row->description : '';
		$category->commonState = (isset($row->common_state_id)) ? CI_CommonState::getById($row->common_state_id) : '';		
		
		return $category;
	}
	
	public static function getCategories()
	{
		$CI = & get_instance();
		$CI->load->model('category_model');
		$results = $CI->category_model->getCategories();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = CI_Category::getInstance($result);
			}
		}
		return $return;
	}
	
	public static function getById($id)
	{
		$CI = & get_instance();
		$CI->load->model('category_model');
		$results = $CI->category_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = CI_Category::getInstance($result);
			}
		}
		return $return;
	}
}
