<?php

class CI_User {
	private $id;
	private $email;
	private $password;
	private $name;
	private $lastName;
	private $birthdayDate;
	private $description;
	private $phones;
	private $addresses;
	private $enabled;
	private $deleted;

	public function getId() {return $this->id;}
	
	public function getEmail(){return $this->email;}
	public function setEmail($email){$this->email = $email;}
	
	public function getPassword(){return $this->password;}
	public function setPassword($password){$this->password = $password;}
	
	public function getName(){return $this->name;}
	public function setName($name){$this->name = $name;}
	
	public function getLastName(){return $this->lastName;}
	public function setLastName($lastName){$this->lastName = $lastName;}

	public function getBirthdayDate(){return $this->birthdayDate;}
	public function setBirthdayDate($birthdayDate){$this->birthdayDate = $birthdayDate;}

	public function getDescription(){return $this->description;}
	public function setDescription($description){$this->description = $description;}

	public function getPhones(){return CI_Phones::getPhonesByUserId ($this->id);}
	// public function setPhones($bio){$this->bio = $bio;}

	public function getAddresses(){return CI_Address::getAddresByUserId ($this->id);}
	// public function setAddresses($bio){$this->bio = $bio;}

	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */
	private function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->email = $this->email;
		$object->password = $this->password;
		$object->name = $this->name;
		$object->lastName = $this->lastName;
		$object->birthdayDate = $this->birthdayDate;
		$object->description = $this->description;
		$object->phones = $this->phones;
		$object->addresses = $this->addresses;
		$object->enabled = $this->enabled;
		$object->deleted = $this->deleted;
		return $object;
	}
	
	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$user = new self;
		$user->id = (isset($row->user_id)) ? $row->user_id : 0;
		$user->email = (isset($row->email)) ? $row->email : '';
		$user->password = (isset($row->password)) ? $row->password : '';
		$user->name = (isset($row->name)) ? $row->name : '';
		$user->lastName = (isset($row->last_name)) ? $row->last_name : '';
		$user->birthdayDate = (isset($row->birthday_date)) ? $row->birthday_date : '';
		$user->description = (isset($row->description)) ? $row->password : '';
		$user->enabled = (isset($row->enabled)) ? $row->enabled : '';
		$user->deleted = (isset($row->deleted)) ? $row->deleted : '';
		$user->phones = CI_Phones::getPhonesByUserId ($user->id);
		//$user->addresses = CI_Address::getAddresByUserId($user->id);
		return $user;
	}
	
	public static function getUsers()
	{
		$CI = & get_instance();
		$CI->load->model('user_model');
		$results = $CI->user_model->getUsers();
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
		$CI->load->model('user_model');
		$results = $CI->user_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}
	
	public function save(){
		$return = TRUE;
		$CI = & get_instance();
		$CI->load->model('user_model');
		if(isset($this->id) && $this->id > 0)
			$CI->user_model->update($this->getData());
		else{
			$this->id = $CI->user_model->create($this->getData());
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}
	
	public function delete()
	{
		$CI =& get_instance();
		$CI->load->model('user_model');
		return $CI->user_model->delete($this->id);
	}
	
	public static function login($options)
	{
		$CI = & get_instance();
		$CI->load->model('user_model');
		$results = $CI->user_model->login($options);
		$return = array();
		if(!empty($results)){
			$return = self::getInstance($results[0]);			
		}
		return $return;
	}

	public function confirmation()
	{
		$CI =& get_instance();
		$CI->load->model('user_model');
		return $CI->user_model->confirmation($this->id);
	}

}
