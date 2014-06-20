<?php

class CI_Subcategory{
	private $id;
	private $category;
	private $description;
	private $commonState;

	public function getId() {return $this->id;}
	
	public function getCategory(){return $this->category;}
	public function setCategory($category){$this->category = CI_Category::getById($category);}

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
		$object->category = CI_Category::getData($options->category);
		$object->description = $options->description;
		$object->commonState = CI_CommonState::getData($options->commonState);
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$subcategory = new self;
		$subcategory->id = (isset($row->subcategory_id)) ? $row->subcategory_id : 0;
		$subcategory->category = (isset($row->category_id)) ? CI_Category::getById($row->category_id) : '';		
		$subcategory->description = (isset($row->description)) ? $row->description : '';
		$subcategory->commonState = (isset($row->common_state_id)) ? CI_CommonState::getById($row->common_state_id) : '';		
		
		return $subcategory;
	}
	
	public static function getSubcategories()
	{
		$CI = & get_instance();
		$CI->load->model('subcategory_model');
		$results = $CI->subcategory_model->getSubcategories();
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
		$CI->load->model('subcategory_model');
		$results = $CI->subcategory_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}
