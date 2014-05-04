<?php

class CI_Message {
	private $id;
	private $userIdFrom;
	private $userIdTo;
	private $publicationId;
	private $firstMessageId;
	private $FAQ;
	private $commonStateId;
	private $subject;
	private $text;
	private $createDate;
	private $updateDate;
	private $deleteDate;

	public function getId() {return $this->id;}

	public function getUserIdFrom() {return $this->userIdFrom;}
	public function setUserIdFrom($userIdFrom) {return $this->userIdFrom = $userIdFrom;}

	public function getUserIdTo() {return $this->userIdTo;}
	public function setUserIdTo($userIdTo) {return $this->userIdTo = $userIdTo;}

	public function getPublicationId(){return $this->publicationId;}
	public function setPublicationId($publicationId){return $this->publicationId = $publicationId;}

	public function getFirstMessageId(){return $this->firstMessageId; }
	public function setFirstMessageId($firstMessageId){return $this->firstMessageId = $firstMessageId;}

	public function getFAQ(){return $this->FAQ;}
	public function setFAQ($FAQ){return $this->FAQ = $FAQ;}

	public function getCommonStateId(){return $this->commonStateId;}
	public function setCommonStateId($commonStateId){return $this->commonStateId = $commonStateId;}

	public function getSubject(){return $this->subject;}
	public function setSubject($subject){return $this->subject = $subject;}

	public function getText(){return $this->text;}
	public function setText($text){return $this->text = $text;}

	public function getCreateDate(){return $this->createDate;}
	public function setCreateDate($createDate){return $this->createDate = $createDate;}

	public function getUpdateDate(){return $this->updateDate;}
	public function setUpdateDate($updateDate){return $this->updateDate = $updateDate;}

	public function getDeleteDate(){return $this->deleteDate;}
	public function setDeleteDate($deleteDate){return $this->deleteDate = $deleteDate;}

/**
	* Devuelve la informacion cargada del objeto 
	* 	
	* Uso interno
	*  
	* @return object
*****/

	private function getData(){
		$object = new stdClass();

		$object->id = $this->id;
		$object->userIdFrom = $this->userIdFrom;
		$object->userIdTo = $this->userIdTo;
		$object->publicationId = $this->publicationId;
		$object->firstMessageId = $this->firstMessageId;
		$object->FAQ = $this->FAQ;
		$object->commonStateId = $this->commonStateId;
		$object->subject = $this->subject;
		$object->text = $this->text;
		$object->createDate = $this->createDate;
		$object->updateDate = $this->updateDate;
		$object->deleteDate = $this->deleteDate;
		
		return $object;
	}

	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}
		$message = new self;
		$message->id = (isset($row->message_id)) ? $row->message_id : 0;
		$message->userIdFrom = (isset($row->user_id_from)) ? $row->user_id_from : '';
		$message->userIdTo = (isset($row->user_id_to)) ? $row->user_id_to : '';
		$message->publicationId = (isset($row->publication_id)) ? $row->publication_id : '';
		$message->firstMessageId = (isset($row->first_message_id)) ? $row->first_message_id : '';
		$message->FAQ = (isset($row->FAQ)) ? $row->FAQ : '';
		$message->commonStateId = (isset($row->common_state_id)) ? $row->common_state_id : '';
		$message->subject = (isset($row->subject)) ? $row->subject : '';		
		$message->text = (isset($row->text)) ? $row->text : '';
		$message->createDate = (isset($row->create_date)) ? $row->create_date : '';
		$message->updateDate = (isset($row->update_date)) ? $row->update_date : '';
		$message->deleteDate = (isset($row->delete_date)) ? $row->delete_date : '';
		return $message;
	}

	public static function getById($id){
		$CI = & get_instance();
		$CI->load->model('message_model');
		$results = $CI->message_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getByUserIdTo($userId){
		$CI = & get_instance();
		$CI->load->model('message_model');
		$results = $CI->message_model->getByUserIdTo($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getByUserIdFrom($userId){
		$CI = & get_instance();
		$CI->load->model('message_model');
		$results = $CI->message_model->getByUserIdFrom($userId);
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
		$CI->load->model('message_model');
		
		if(isset($this->id) && $this->id > 0)
			$CI->message_model->update($this->getData());
		else{
			$this->id = $CI->message_model->create($this->getData());
			if($this->id === null)
				$return = FALSE;
		}
		return $return;
	}

	public function delete(){
		$CI =& get_instance();
		$CI->load->model('message_model');
		return $CI->message_model->delete($this->id);
	}
}