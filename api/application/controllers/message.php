<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Message extends REST_Controller{

	public function index_get(){

		checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";
		$return["data"] = "";

		$id = $this->get("id"); 
		$userIdFrom = $this->get("userIdFrom"); 
		$userIdTo = $this->get("userIdTo"); 
		$publicationId = $this->get("publicationId"); 
		$firstMessageId = $this->get("firstMessageId"); 

		if($id){
			$messages = CI_Message::getById($id);	
		}elseif ($userIdFrom) {
			$messages = CI_Message::getByUserIdFrom($userIdFrom);
		}elseif ($userIdTo) {
			$messages = CI_Message::getByUserIdTo($userIdTo);
		}elseif ($publicationId) {
			$messages = CI_Message::getByPublicationId($publicationId);
		}elseif ($firstMessageId) {
			$messages = CI_Message::getConversation($firstMessageId);
		}else{
			$messages = CI_Message::getAll();
		}

		if($messages){
			$status = 200;
			$return["result"] = "OK";
			$return["data"] = "";
			
			foreach ($messages as $key => $message) {
				$myMessage = new  stdClass();
				$myMessage->id = $message->getId();
				$myMessage->userIdTo = $message->getUserIdTo();
				$myMessage->userIdFrom = $message->getUserIdFrom();
				$myMessage->publicationId = $message->getPublicationId();
				$myMessage->firstMessageId = $message->getFirstMessageId();
				$myMessage->FAQ = $message->getFAQ();
				$myMessage->commonState = $message->getCommonState();
				$myMessage->subject = $message->getSubject();
				$myMessage->text = $message->getText();
				$myMessage->createDate = $message->getCreateDate();
				$myMessage->updateDate = $message->getUpdateDate();
				$return["data"][$key] = $myMessage;
			 } 
		}


        $this->response($return, $status);
	}

	public function index_post(){
		checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";
		$return["data"] = "";

		$this->load->helper('date');
		$datestring = "%Y/%m/%d %H:%i:%s";
		$currDate = mdate($datestring, now());
		$arrOptions['id'] = ($this->post('id') > 0) ? $this->post('id') : 0;
		$id = $arrOptions['id'];
		$arrOptions['userIdFrom'] = $this->post('userIdFrom');
		$arrOptions['userIdTo'] = $this->post('userIdTo');
		$arrOptions['publicationId'] = $this->post('publicationId');
		$arrOptions['firstMessageId'] = $this->post('firstMessageId');
		$arrOptions['FAQ'] = $this->post('FAQ');
		$arrOptions['commonStateId'] = $this->post('commonStateId');
		$arrOptions['subject'] = $this->post('subject');
		$arrOptions['text'] = $this->post('text');
		$arrOptions['createDate'] = $currDate;
		$arrOptions['updateDate'] = $currDate;
		
		$options = array();
		$options['userIdFrom'] = $arrOptions['userIdFrom'];
		$options['userIdTo'] = $arrOptions['userIdTo'];

		if( !$this->isValidToInsert($options)){
			$this->response($return, $status);
		}

		$message = $id > 0 ? CI_Message::getById($id) : new CI_Message();
		$message ->setUpdateDate($arrOptions['updateDate']);
		$message ->setCreateDate($arrOptions['createDate']);
		$message ->setUserIdFrom($arrOptions['userIdFrom']);
		$message ->setUserIdTo($arrOptions['userIdTo']);
		$message ->setPublicationId($arrOptions['publicationId']);
		$message ->setFirstMessageId($arrOptions['firstMessageId']);
		$message ->setFAQ($arrOptions['FAQ']);
		$message ->setCommonState(CI_CommonState::getById($arrOptions['commonStateId']));
		$message ->setSubject($arrOptions['subject']);
		$message ->setText($arrOptions['text']);
	
		if($message->save()){
			$myMessage = new stdClass();
			$myMessage->id = $message->getId();
			$myMessage->userIdTo = $message->getUserIdTo();
			$myMessage->userIdFrom = $message->getUserIdFrom();
			$myMessage->publicationId = $message->getPublicationId();
			$myMessage->firstMessageId = $message->getFirstMessageId();
			$myMessage->FAQ = $message->getFAQ();			
			$myMessage->commonState = $message->getCommonState();			
			$myMessage->subject = $message->getSubject();
			$myMessage->text = $message->getText();
			$myMessage->createDate = $message->getCreateDate();
			$myMessage->updateDate = $message->getUpdateDate();
			
			$status = 200;
			$return["result"] = "OK";
			$return["data"] = $myMessage;
		} 

		$this->response($return, $status);
	}

	public function index_delete(){
		$status = 404;
		$return["data"] = "";
		$return["result"] = "NOOK";

		$id = ($this->delete('id') > 0) ? $this->delete('id') :0;
		if($id > 0){
			$message = CI_Message::getById($id);
			$message = $message[0];
			if($message->delete()){
				$status = 200;
				$return["result"] = "OK";
			}
		}
		$this->response($return, $status);
	}

}