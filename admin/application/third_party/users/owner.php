<?php


class Owner extends User
{

	protected $pedidos;
        protected $tablet;
        protected $product;
    
        public function __construct(Pedidos $pedidos, 
					Tablet $tablet, 
					Product $product, 
					Array $userdata)
	{
            $pedidos = new Pedido();
            $tablet = new Tablet();
            $product = new Product();
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

	public function cambiarEstadoPedido()
	{}
	
	public function createProduct()
	{
            $product = new product($productData);
        }

	/*
	* Via web service. No se ejecuta en local porque el servidor global
	* debe conocer y saber cuales y cuantas sucursales tiene el cliente.
	*/
	public function addSucursal()
	{}
	
	public function deleteUser(User $user)
	{
		if($user->id == 1)
			throw new Exception("EL usuario root/dueño no puede ser borrado");
		//TODO logica de borrado de usuario
        }
        
        protected function create()
	{
            $CI = $this->CI;
            $CI->load->model("user_model");
            if($CI->user_model->createClient($this)){
                return true;
            } else {
                return false;
            }            
	}
        
	protected function update()
	{
            $CI = $this->CI;
            $CI->load->model("user_model");
            if($CI->user_model->updateClient($this)){
                return true;
            }
            return false;
	}
}
