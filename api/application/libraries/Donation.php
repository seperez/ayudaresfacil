<?php

class CI_Donation {
	private $id;
	private $userId;
	private $publicationId;
	private $donationDate;
	private $processState;
	private $donatedObjects;

	public function getId() {return $this->id;}
	
	public function getUserId(){return $this->userId;}
	public function setUserId($userId){$this->userId = $userId;}

	public function getPublicationId(){return $this->publicationId;}
	public function setPublicationId($publicationId){$this->publicationId = $publicationId;}// = CI_Publication::getById($publication);
	
	public function getDonationDate(){return $this->donationDate;}
	public function setDonationDate($donationDate){$this->donationDate = $donationDate;}// = CI_Publication::getById($publication);

	public function getProcessState(){return $this->processState;}
	public function setProcessState($processState){$this->processState = $processState;}// = CI_Publication::getById($publication);	

	public function getDonatedObjects(){return $this->donatedObjects;}
	public function setDonatedObjects($donatedObjects){$this->donatedObjects = $donatedObjects;}
	
	/**
	 * Devuelve la informacion cargada del objeto 
	 * Uso interno
	 * @return object
	 */

	protected function getData(){
		$object = new stdClass();
		$object->id = $this->id;
		$object->userId = $this->userId;
		$object->publicationId = $this->publicationId;
		$object->donationDate = $this->donationDate;
		$object->processState = $this->processState;
		$object->donatedObjects = $this->donatedObjects;
		return $object;
	}


	protected static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	

		$object = new self;
		$object->id = (isset($row->donation_id)) ? $row->donation_id : 0;
		$object->userId = (isset($row->user_id)) ? $row->user_id : '';
		$object->publicationId = (isset($row->publication_id)) ? $row->publication_id : '';//CI_Publication::getById($row->publication_id) : '';
		$object->donationDate = (isset($row->donation_date)) ? $row->donation_date : '';
		$object->processState = (isset($row->process_state_id)) ? CI_ProcessState::getById($row->process_state_id) : '';
		$object->donatedObjects = (isset($row->publication_id)) ? CI_DonatedObject::getByDonationId($row->donation_id) : '';
		return $object;
	}

	public static function getById($id)
	{
		$CI = & get_instance();
		$CI->load->model('donation_model');
		$results = $CI->donation_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getDonations()
	{
		$CI = & get_instance();
		$CI->load->model('donation_model');
		$results = $CI->donation_model->getDonations();
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getByPublicationId($publicationId)
	{
		$CI = & get_instance();
		$CI->load->model('donation_model');
		$results = $CI->donation_model->getByPublicationId($publicationId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getByUserId($userId)
	{
		$CI = & get_instance();
		$CI->load->model('donation_model');
		$results = $CI->donation_model->getByUserId($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public function save(){
		$return = TRUE;
		$CI =& get_instance();
		$CI->load->model('donation_model');

		if(isset($this->id) && $this->id > 0)
			$CI->donation_model->update($this->getData());
		else{
			$this->id = $CI->donation_model->create($this->getData());
			if($this->id === null)
				$return = FALSE;
			else
				$return = $this->id;
		}
		return $return;
	}

}