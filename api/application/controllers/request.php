<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Request extends REST_Controller{

	/*
	public function index_get(){

		checkIsLoggedIn($this);

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
	}*/

	public function index_get(){
		
		//checkIsLoggedIn($this);

		$status = 404;
		$return["result"] = "NOOK";

		$arrOptions['publicationId'] = ($this->get('publicationId') > 0) ? $this->get('publicationId') : 0;
		$arrOptions['user'] = $this->get('userId');
		$arrOptions['type'] = $this->get('publicationTypeId');
		$arrOptions['creationDate'] = $this->get('creationDate');
		$arrOptions['title'] = $this->get('title');
		$arrOptions['description'] = $this->get('description');
		$arrOptions['expirationDate'] = $this->get('expirationDate');
		$arrOptions['category'] = $this->get('categoryId');
		$arrOptions['subcategory'] = $this->get('subcategoryId');
		$arrOptions['views'] = $this->get('views');
		$arrOptions['processState'] = $this->get('processStateId');
		$arrOptions['object'] = $this->get('objectId');
		$arrOptions['quantity'] = $this->get('quantity');

		if($arrOptions['publicationId'] > 0){
			$request = CI_Request::getById($arrOptions['publicationId']);
			if ($request <> NULL) {
				$request = CI_Request::getDataFromArray($arrOptions);
			}						
		}else{
			$request = CI_Request::getDataFromArray($arrOptions);
		}

		if ($request <> NULL) {
			$arrInfo['user'] = $arrOptions['user'];
			$arrInfo['type'] = $arrOptions['type'];
			$arrInfo['request'] = $request;

			$id = CI_Request::save($arrInfo);

			if($id <> NULL){
				$status = 200;
				$return["result"] = "OK";
				$return["data"] = "";			
				$return["publicationId"] = $id;
				$myRequest = CI_Request::getData($request);	
				$return["data"] = $myRequest;
			}
		}
        $this->response($return, $status);
	}
}