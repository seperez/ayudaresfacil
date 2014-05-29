<?php

class CI_Phone {
	private $id;
	private $number;
	private $type;

	public function getId() {return $this->id;}
	
	public function getNumber(){return $this->number;}
	public function setNumber($number){$this->number = $number;}
	
	public function getType(){return $this->type;}
	public function setType($type){$this->type = CI_PhoneType::getById($type);}
	
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */
	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->number = $this->number;
		$object->type = $this->type->id;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$user = new self;
		$user->id = (isset($row->user_id)) ? $row->user_id : 0;
		$user->number = (isset($row->number)) ? $row->number : '';
		$user->type = (isset($row->type_phone_id)) ? CI_PhoneType::getById($row->type_phone_id) : '';
		return $user;
	}
	
	public static function getPhonesByUserId($userId)
	{
		$CI = & get_instance();
		$CI->load->model('phone_model');
		$results = $CI->phone_model->getPhonesByUserId($userId);
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
		$CI->load->model('phone_model');
		$results = $CI->phone_model->getPhoneById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
	
	public function save($userId){
		$return = TRUE;
		$CI = & get_instance();
		$CI->load->model('phone_model');
		$data = $this->getData();
		$data['userId'] = $userId;
		if(isset($this->id) && $this->id > 0)
			$CI->phone_model->update($data);
		else{
			$this->id = $CI->phone_model->create($data);
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}
	
	public function delete()
	{
		$CI =& get_instance();
		$CI->load->model('phone_model');
		return $CI->phone_model->delete($this->id);
	}
}
