<?php

class CI_OfferType {
	private $id;
	private $description;
	private $comment;

	public function getId() {return $this->id;}

	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getComment(){return $this->comment;}
	public function setComment($comment){$this->comment = $comment;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * 		
	 * Uso interno
	 *  
	 * @return object
	 */

	public function getData($options){
		$object = new CI_OfferType();
		$object->id = $options->id;
		$object->description = $options->description;
		$object->comment = $options->comment;
		return $object;
	}

	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$offer = new CI_OfferType;
		$offer->id = (isset($row->offer_type_id)) ? $row->offer_type_id : 0;
		$offer->description = (isset($row->description)) ? $row->description : '';
		$offer->comment = (isset($row->comments)) ? $row->comments : '';
		return $offer;
	}

	public static function getById($id){
		$CI =& get_instance();
		$CI->load->model('offer_type_model');
		$results = $CI->offer_type_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = CI_OfferType::getInstance($result);
			}
		}
		return $return;
	}
}