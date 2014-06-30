<?php

class CI_Request extends CI_Publication {
		
	public function getDataFromArray($options){
		$request = parent::getDataFromArray($options);
		return $request;
	}

	public function getData($options){
		$request = parent::getData($options);
		return $request;
	}

	public static function getInstance($row){
		if(!($row instanceof stdClass)){
			show_error("El row debe ser una instancia de stdClass.");
		}	
		$request = parent::getInstance($row);
		return $request;
	}

	public static function getById($id){
		$CI =& get_instance();
		$CI->load->model('request_model');
		$results = $CI->request_model->getById($id);
		$return = array();
		if(!empty($results)){
			foreach($results as $result){
				$return[] = CI_Request::getInstance($result);
			}
		}
		return $return;
	}

	public static function getByUser($userId){
		$CI =& get_instance();
		$CI->load->model('request_model');
		$results = $CI->request_model->getByUser($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result){
				$return[] = CI_Request::getInstance($result);
			}
		}
		return $return;
	}

	public function save($arrInfo){
		$request = $arrInfo["request"];
		$arrInfo["request"] = CI_Request::getData($request);
		$CI =& get_instance();
		$CI->load->model('request_model');
		$id = ' ';
		if(isset($request->id) && $request->id > 0){
			$id = $request->id;
			$CI->request_model->update($arrInfo["request"]);
		}else{
			$id = $CI->request_model->create($arrInfo);
		}
		return $id;
	}

	public function delete($request){
		$CI =& get_instance();
		$CI->load->model('request_model');
		return $CI->request_model->delete($request->id);
	}

	public static function getCurrentRequests(){
		$CI =& get_instance();
		$CI->load->model('request_model');
		$results = $CI->request_model->getCurrentRequests();
		$return = array();
		if(!empty($results)){
			foreach($results as $result){
				$return[] = CI_Request::getInstance($result);
			}
		}
		return $return;
	}

	public static function getFavoritesByUser($userId){
		$CI =& get_instance();
		$CI->load->model('request_model');
		$results = $CI->request_model->getFavoritesByUser($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result){
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public function checkExistingFavorite($data){
		$CI =& get_instance();
		$CI->load->model('request_model');
		
		return $CI->request_model->checkExistingFavorite($data);
	}

	public function setAsFavorite($options){
		$userId = $options['userId'];
		$request = $options['request'];

		$CI =& get_instance();
		$CI->load->model('request_model');

		$data = array (
			"publication_id" => $request->id, 
			"user_id" => $userId,
			"request" => $request
		);

		if (CI_Request::checkExistingFavorite($data)){
			unset($data["request"]);
			return $CI->request_model->setAsFavorite($data);					
		}
	}

	public function deleteFromFavorites($options){
		$userId = $options['userId'];
		$request = $options['request'];

		$CI =& get_instance();
		$CI->load->model('request_model');

		$data = array (
			"publication_id" => $request->id, 
			"user_id" => $userId,
			"request" => $request
		);

		if(!(CI_Offer::checkExistingFavorite($data))){
			unset($data["request"]);
			return $CI->request_model->deleteFromFavorites($data);					
		}
	}
	
	/*
	public static function getMonetaryRequestsByUserId($userId){
		$CI =& get_instance();
		$CI->load->model('request_model');
		$results = $CI->request_model->getMonetaryRequestsByUserId($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}

	public static function getObjectRequestsByUserId($userId){
		$CI =& get_instance();
		$CI->load->model('request_model');
		$results = $CI->request_model->getObjectRequestsByUserId($userId);
		$return = array();
		if(!empty($results)){
			foreach($results as $result) {
				$return[] = self::getInstance($result);
			}
		}
		return $return;
	}
	*/
}