<?php

class CI_Image {
	private $id;
	private $path;

	public function getId() {return $this->id;}
	
	public function getPath(){return $this->path;}
	public function setPath($path){$this->path = $path;}
		
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	public function getData($options){
		$image = new stdClass();
		$image->id = $options->id;
		$image->path = $options->path;
		return $image;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$image = new CI_Image();
		$image->id = (isset($row->image_id)) ? $row->image_id : 0;
		$image->path = (isset($row->path)) ? $row->path : '';
		return $image;
	}
	
	public static function getImages()
	{
		$CI = & get_instance();
		$CI->load->model('image_model');
		$results = $CI->image_model->getImages();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = CI_Image::getInstance($result);
			}
		}
		return $return;
	}

	public static function getById($id)
	{
		$CI = & get_instance();
		$CI->load->model('image_model');
		$results = $CI->image_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = CI_Image::getInstance($result);
			}
		}
		return $return;
	}
}
