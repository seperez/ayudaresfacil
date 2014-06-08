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

	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->description = $this->description;
		$object->comment = $this->comment;
		return $object;
	}

	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$offer = new self;
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
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
}