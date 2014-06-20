<?php

class Client extends User 
{
	
	/*
	* EL cliente es identificado por la mesa en la que esta sentado.
	* Los pedidos se realizan sobre la mesa y no sobre el cliente
	* a menos que este este registrado y logueado.
	*/
	protected $table;
        protected $tablet;
        protected $pedido;
	
	public function __construct(Array $userdata)
	{
		$this->tablet = new Tablet();
                $this->$table = $this->native_session->userdata('table');
                $this->pedido = new Pedido;
                $this->noLogin();
	}
	
        /**
         *  Loguea al cliente sin sobreescribir la session del mozo.
         *  El mozo es quien atiende la mesa y al cliente. No puede perderse
         *  La relacion. Solo guardando el id del cliente es suficiente
         *  como para obtener la instancia del mismo para identificarlo.
         */
	public function login($location)
	{
            $CI = $this->CI;
            $userdata = array(
                "cliente_id" => $this->id,
                "location" => $location
            );
            //borramos la data anonima
            $CI->native_session->unset_userdata('cliente_anonimo');
            //creamos la nueva session con el cliente ya identificado
            $CI->native_session->set_userdata($userdata);  
        }
	
	/**
	* Genera una variable de sesion que sera destruida si el 
	* cliente se loguea al sistema. De otra forma, permanece como 
	* anonimo utilizando esta session. Si el usuario esta logueado
	* este metodo no debe ejecutarse.
	*/
	public function noLogin()
	{
           $CI = $this->CI;
           $CI->native_session->userdata("cliente_anonimo", random_string(4));
        }
	
	public function generarPedido()
	{
            
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
