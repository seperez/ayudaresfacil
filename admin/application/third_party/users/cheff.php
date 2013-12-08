<?php

class cheff extends User
{
	protected $pedido;
	protected $horasTrabajadas;
	protected $address;		
	
	public function __construct(Array $userdata)
	{
            $this->address = $userdata["address"];
            $this->pedido = new Pedido();
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
                "address" => $this->address,
                "type" => get_class($this),
                "location" => $location
            );
            $CI->native_session->set_userdata($userdata);            
        }
	
	public function estadoPedido() 
        {}
	
	public function verPedido() 
        {}
	
	public function cambiarEstadoPedido() 
        {}
        
        protected function create()
	{
            $CI = $this->CI;
            $CI->load->model("user_model");
            if($CI->user_model->createCheff($this)) {
                return true;
            }
            return false;
        }
        
        protected function update()
        {
            $CI = $this->CI;
            $CI->load->model("user_model");
            if($CI->user_model->updateCheff($this)){
                return true;
            }
            return false;
        }
}
