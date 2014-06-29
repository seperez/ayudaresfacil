<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Request extends REST_Controller{

	public function index_get(){

		//checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";

		$id = $this->get("publicationId"); 
		$userId = $this->get("userId");
		
		if($id){
			$requests = CI_Request::getById($id);	
		}elseif ($userId) {
			$requests = CI_Request::getByUser($userId);	
		}else{
			$requests = CI_Request::getCurrentRequests();
		}
		if($requests){
			$status = 200;
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($requests as $key => $request) {
				$myRequest = CI_Request::getData($request);
				$return["data"][$key] = $myRequest;
			 } 
		}
        $this->response($return, $status);
	}

	/*
	public function index(){}

	public function getById(){
		$id = $this->input->get('publicationId');
		$return["result"] = "NOOK";
		$request = CI_Request::getById($id);	

		if($request){
			$return["result"] = "OK";
			$myRequest = CI_Request::getData($request);	
			$return["data"] = $myRequest;
		}
		echo json_encode($return);
	}

	public function getByUser(){
		$userId = $this->input->get('userId');
		$return["result"] = "NOOK";
		$requests = CI_Request::getByUser($userId);	

		if($requests){
			$return["result"] = "OK";
			$return["data"] = "";

			foreach ($requests as $key => $request) {
				$myRequest = CI_Request::getData($request);
				$return["data"][$key] = $myRequest;
			 } 
		}
		echo json_encode($return);
	}

	public function save(){
		$arrOptions['publicationId'] = ($this->input->get('publicationId') > 0) ? $this->input->get('publicationId') : 0;
		$arrOptions['user'] = $this->input->get('userId');
		$arrOptions['type'] = $this->input->get('publicationTypeId');
		$arrOptions['creationDate'] = $this->input->get('creationDate');
		$arrOptions['title'] = $this->input->get('title');
		$arrOptions['description'] = $this->input->get('description');
		$arrOptions['expirationDate'] = $this->input->get('expirationDate');
		$arrOptions['category'] = $this->input->get('categoryId');
		$arrOptions['subcategory'] = $this->input->get('subcategoryId');
		$arrOptions['views'] = $this->input->get('views');
		$arrOptions['processState'] = $this->input->get('processStateId');
		$arrOptions['object'] = $this->input->get('objectId');
		$arrOptions['quantity'] = $this->input->get('quantity');

		if($arrOptions['publicationId'] > 0){
			$request = CI_Request::getById($arrOptions['publicationId']);

			$request->setTitle($arrOptions['title']);
			$request->setDescription($arrOptions['description']);
			$request->setCategory($arrOptions['category']);
			$request->setSubcategory($arrOptions['subcategory']);
			$request->setObject($arrOptions['object']);
			$request->setQuantity($arrOptions['quantity']);
			$request->setViews($arrOptions['views']);
			$request->setProcessState($arrOptions['processState']);
			$request->setCreationDate($arrOptions['creationDate']);
			$request->setExpirationDate($arrOptions['expirationDate']);

		}else{
			$request = CI_Request::getDataFromArray($arrOptions);
		}

		$userId = $arrOptions['user'];
		$id = $request->save($userId);

		if($id === NULL){
			$return["result"] = "NOOK";
		}else{
			$return["result"] = "OK";			
			$return["publicationId"] = $id;
			$myRequest = CI_Request::getData($request);	
			$return["data"] = $myRequest;
		}
		echo json_encode($return);
	}
	*/

}