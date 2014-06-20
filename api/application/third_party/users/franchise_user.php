<?php

/**
 * El usuario franquicia es un usuario vendedor
 * que tiene capacidades superiores al owner pero no 
 * tiene todos los permisos como el root.
 */

class Franchise_User extends User
{
    protected $address;
    
    public function __construct($userdata) 
    {
        $this->direccion = $userdata["address"];
        parent::__construct($userdata);
    }
    
    public function createShop($shopdata)
    {}
    
    public function login()
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
    
}