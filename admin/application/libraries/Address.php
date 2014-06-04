<?php

class CI_Address {
	private $id;
	private $street;
	private $number;
	private $floor;
	private $apartment;
	private $postalCode;
	private $province;
	private $department;
	private $city;
	private $isPrincipal;

	public function getId() {return $this->id;}
	
	public function getStreet(){return $this->street;}
	public function setStreet($street){$this->street = $street;}

	public function getNumber(){return $this->number;}
	public function setNumber($number){$this->number = $number;}
	
	public function getFloor(){return $this->floor;}
	public function setFloor($floor){$this->floor = $floor;}

	public function getApartment(){return $this->apartment;}
	public function setApartment($apartment){$this->apartment = $apartment;}

	public function getPostalCode(){return $this->postalCode;}
	public function setPostalCode($postalCode){$this->postalCode = $postalCode;}

	public function getProvince(){return $this->province;}
	public function setProvince($province){$this->province = CI_Province::getById($province);}
	
	public function getDepartment(){return $this->department;}
	public function setDepartment($department){$this->department = CI_Department::getById($department);}

	public function getCity(){return $this->city;}
	public function setCity($city){$this->city = CI_City::getById($city);}

	public function getPrincipal(){return $this->principal;}
	public function setPrincipal($principal){$this->principal = $principal;}
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */
	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->street = $this->street;
		$object->number = $this->number;
		$object->floor = $this->floor;
		$object->apartment = $this->apartment;
		$object->postalCode = $this->postalCode;
		$object->principal = $this->principal;
		$object->province = $this->province->getId();
		$object->department = $this->department->getId();
		$object->city = $this->city->getId();
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$address = new self;
		$address->id = (isset($row->user_id)) ? $row->user_id : 0;
		$address->street = (isset($row->street)) ? $row->street : '';
		$address->number = (isset($row->number)) ? $row->number : '';
		$address->floor = (isset($row->floor)) ? $row->floor : '';
		$address->apartment = (isset($row->apartment)) ? $row->apartment : '';
		$address->postalCode = (isset($row->postal_code)) ? $row->postal_code : '';
		$address->city = (isset($row->city_id)) ? CI_City::getById($row->city_id) : '';
		//$address->department = ($address->city != '') ? CI_Department::getDepartmentByCityId($address->city->getId()) : '';
		//$address->province = ($address->department != '') ? CI_Province::getProvinceByDepartmentId($address->department->getId()) : '';
		return $address;
	}
	
	public static function getAddressesByUserId($userId)
	{
		$CI = & get_instance();
		$CI->load->model('address_model');
		$results = $CI->address_model->getAddressesByUserId($userId);
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
		$CI->load->model('address_model');
		$results = $CI->address_model->getAddressById($id);
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
		$CI->load->model('address_model');
		$data = $this->getData();
		$data->userId = $userId;
		if(isset($this->id) && $this->id > 0)
			$CI->address_model->update($data);
		else{
			$this->id = $CI->address_model->create($data);
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}
	
	public function delete()
	{
		$CI =& get_instance();
		$CI->load->model('address_model');
		return $CI->address_model->delete($this->id);
	}
}
