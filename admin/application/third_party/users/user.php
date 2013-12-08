<?php

abstract class User
{
	
	protected $id;
	protected $name;
	protected $username;
	protected $password;
	protected $email;
	protected $created; //Timestame
	protected $role;
	protected $CI;
	
	abstract public function login($location);

	public function __construct(Array $userdata) {
		$this->CI = &get_instance();
                $this->name = $userdata["name"];
                $this->username = $userdata["username"];
                $this->password = $userdata["password"];
                $this->email = $userdata["email"];
                $this->role = $userdata["role"];
	}
	
	public function logout() 
	{
		$this->native_session->destroy();
	}
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setUsername($username)
	{
		$this->username = $username;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function getCreated()
	{
		return $this->created;
	}
	
	public function setRole($role)
	{
		$this->role = $role;
	}
	
	public function getRole()
	{
		return $this->role;
	}
	
	/*
	* Crea un usuario de algun tipo a partir de un array(session)
	*/
	public static function buildUser(array $userdata)
	{
		$types = get_active_types();
		if(in_array($userdata['type'],$types)){
			$type = $userdata['type'];
			$user = new $type($userdata);
		} else {
			throw new Exception("EL usuario no pertenece a ningun tipo existente");
		}		
	}
        
        public function save() {
            if(!isset($this->id)) {
                $this->create();
            } else {
                $this->update();
            }            
        }
       
}
