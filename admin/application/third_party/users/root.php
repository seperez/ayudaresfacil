<?php

class Root extends User
{
    public function __construct($userdata) {
        parent::__construct($userdata);
    }
    
    public function login($location)
    {
        $CI = $this->CI;
        $userdata = array(
            "id" => $this->id,
            "name" => $this->name,
            "username" => $this->username,
            "password" => $this->password,
            "email" => $this->email,
            "created" => $this->created,
            "role" => $this->role,
            "type" => get_class($this),
            "location" => $location
        );
        $CI->native_session->set_userdata($userdata);             
    }
    
    public function createFranchiseUser()
    {}
    
    public function createShop()
    {}
    
    public function createTablet()
    {}
}
