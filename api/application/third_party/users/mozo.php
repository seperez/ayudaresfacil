<?php

class Mozo extends User
{
	protected $address;
	protected $age;
        protected $table;
        protected $pedido;
        protected $tablet;
	
	public function __construct(Array $userdata)
	{
            $this->pedido = new Pedido();
            $this->tablet = new Tablet();
            $this->age = $userdata["age"];
            $this->address = $userdata["address"];
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
                "location" => $location,
                "table" => $this->table
            );
            $CI->native_session->set_userdata($userdata); 
        }
	
	public function activateTable()
	{}
	
	public function closeTable()
	{}
        
        public function setMesa($tableNumber)
        {
            $this->table = $tableNumber;
            $CI->native_session->set_userdata('table', $this->table);
        }
        
        protected function create()
	{
            $CI = $this->CI;
            $CI->load->model("user_model");
            $mozo = new Mozo($userdata);
            if($CI->user_model->createMozo($this)){
                return true;
            } else {
                return false;
            }
        }
        
        protected function update()
        {
            $CI = $this->CI;
            $CI->load->model("user_model");
            if($CI->user_model->updateMozo($this)){
                return true;
            }
            return false;
        }
}
