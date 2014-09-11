<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Donation extends REST_Controller{

	public function index_get(){

		$status = 404;
		$return['result'] = 'NOOK';
		$return['data'] = '';

		$id = $this->get('id'); 
		$userId = $this->get('userId'); 
		$publicationId = $this->get('publicationId');

		if($id){
			$donations = CI_Donation::getById($id);	
		}elseif ($userId) {
			$donations = CI_Donation::getByUserId($userId);
		}elseif ($publicationId) {
			$donations = CI_Donation::getByPublicationId($publicationId);
		}else{
			$donations = CI_Donation::getDonations();
		}

		if($donations){
			$return['result'] = 'OK';
			$return['data'] = '';
			$status = 200;
			foreach ($donations as $key => $donation) {
			 	$myDonation = new stdClass();
				$myDonation->id = $donation -> getId();
				$myDonation->userId = $donation -> getUserId();
				$myDonation->publicationId = $donation -> getPublicationId();
				$myDonation->donationDate = $donation -> getDonationDate();
				$myDonation->processState = $donation -> getProcessState();
				$myDonation->donatedObjects = $donation -> getDonatedObjects();
				$return['data'][$key] = $myDonation;
			 } 
		}

		if($return)
            $this->response($return, $status);
        else
            $this->response(array('error' => 'Couldn\'t find any donations!'), 404);

	}

	public function index_post(){

		$arrOptions['id'] = $this->input->post('id') ? $this->input->post('id') : 0;
		$arrOptions['userId'] = $this->input->post('userId')? $this->input->post('userId') : '';
		$arrOptions['publicationId'] = $this->input->post('publicationId') ? $this->input->post('publicationId')  : '';
		$arrOptions['donatedObjects'] = $this->input->post('donatedObjects') ? $this->input->post('donatedObjects') : '';
		
		$objs = array();
		$donatedObjects = $arrOptions['donatedObjects'];

		//ma($donatedObjects);

		//$donatedObjectsList = CI_DonatedObject::setFromArray($objs);

		if($arrOptions['id'] > 0){
			$donation = CI_Donation::getById($arrOptions['id']);
			//quitar todos los obj y volver a insertarlo
		}else{
			$donation = new CI_Donation();
		}
		
		$donation->setUserId($arrOptions['userId']);
		$donation->setPublicationId($arrOptions['publicationId']);
		$donation->setDonatedObjects($donatedObjects);

		if($id = $donation->save()){
			foreach ($donatedObjects as $donObject) {
				$donatedObject = new CI_DonatedObject();
				$donatedObject->setDonationId($id);
				$donatedObject->setObjectId($donObject['objectId']);
				$donatedObject->setQuantity($donObject['quantity']);
				$donatedObject->save();
			}

			$return['result'] = 'OK';
			$myDonation = new stdClass();
			$myDonation->id = $donation->getId();
			$myDonation->userId = $donation->getUserId();
			$myDonation->publicationId = $donation->getPublicationId();
			$myDonation->donatedObjects = $donation->getDonatedObjects();

			$return['data'] = $myDonation;
		}else{
			$return['result'] = 'NOOK';
		}
		echo json_encode($return);
	}

	public function notify_post(){
		$status = 404;
		$return['result'] = 'NOOK';
		$return['data'] = '';

		$id = $this->input->post('id');
		$donations = CI_Donation::getById($id);
		if(empty($donations)){
			$this->response($return, $status);
		}

		$donation = $donations[0];
		$publication = CI_Request::getById($donation-> getPublicationId())[0];
		$publicationId = $donation-> getPublicationId();
		$userIdTo = $donation->getUserId();
		$userIdFrom = $publication->userId;

		$ownerPublication = CI_User::getById($userIdFrom)[0];
		$ownerDonation = CI_User::getById($userIdTo)[0];

		$options['donatedObjects'] = $donation->getDonatedObjects();
		$options['nameOwnerPublication'] = $ownerPublication->getName();
		$options['nameOwnerDonation'] = $ownerDonation->getName();
		$options['publicationTitle'] = $publication->title;
		$options['personalDataOwnerDonation'] = $ownerDonation->getPersonalData();

		$notifyMessage = new CI_Message();
		$notifyMessage->setUserIdTo($userIdTo);
		$notifyMessage->setUserIdFrom($userIdFrom);
		$notifyMessage->setPublicationId($publicationId);
		$notifyMessage->setCommonState('N');

		$notifyMessage->setNotifyText($options);

		if($notifyMessage->save()){
			$status = 200;
			$return['result'] = 'OK';
			$return['data'] = $donation;
		}

		$this->response($return, $status);

	}

}