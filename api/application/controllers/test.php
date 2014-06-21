<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller{
    
	public function __construct(){
		parent::__construct();	
		//checkLogin();
	}
		
	public function index() {
		// **
		// CI_PhoneType
		// **
  		// $phoneTypes = CI_PhoneType::getPhoneTypes();
  		// ma($phoneTypes);

		// $phoneType = CI_PhoneType::getById(1);
  		// ma($phoneType);
        
        // **
		// CI_Phone
		// **
        // $phones = CI_Phone::getPhonesByUserId(1);
        // ma($phones);

        // $phones = CI_Phone::getById(1);
        // ma($phones);

		// **
		// CI_User
		// **
  		//$users = CI_User::getUsers();
		//$myPhones = $users[0]->getPhones();
  		//ma($myPhones);
		// $myPhones[1]->delete();

		$users = CI_User::getUsers();
		ma($users);

		// **
		// CI_Publication
		// **


<<<<<<< HEAD
		//$myOffer = CI_Offer::getById(1);
		//ma($myOffer);
		//$myOffer->getFavoritesByUserId(1);
=======
		// $myOffer = CI_Offer::getById(1);
		// ma($myOffer);
		// $myOffer->getFavoritesByUserId(1);

		echo CI_VERSION;
>>>>>>> 53806dc83f5d279d6822f7f71d1fd211c28a24cb
    }    
}
