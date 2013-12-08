<?php

require "constants.php";
require "user.php";
require "root.php";
require "franchise.php";
require "owner.php";
require "mozo.php";
require "cheff.php";
require "client.php";

/**
* Devuelve una instancia del usuario logueado
*/
function get_loggedin_user()
{
    $userdata = $this->session->userdata();
    if(empty($userdata)) {
        return null;
    }
    $user = User::buildUser($userdata);
    return $user;
}

/**
* Realiza el login, crea la session y devuelve la instancia
* a partir de los datos obtenidos.
*/
function do_login()
{
    $CI =& get_instance();
    $CI->load->model("user_model");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $location = $_POST["location"];
    if(empty($username) || empty($password) || empty($location)){
        $CI->session->set_flashdata("msg","El usuario y/o password estan vacios");
        redirect(base_url() . "/login");
    }
    
    if($location != POS_LOCATION || $location != TABLET_LOCATION){
        throw new Exception("Los datos que esta intentando pasar no son validos.");
    }
    
    $userdata = $CI->user_model->validate_login($username, $password);
    if($userdata) {
        $user = User::buildUser($userdata);
        $user->login($location);
        return true;
    }
    return false;
}

function do_logout()
{
    $user = get_loggedin_user();
    $user->logout;
}

/**
* Garantiza que el usuario este logueado de otra forma
* genera una excepcion.
*/
function gatekeeper()
{
    $user = get_loggedin_user();
    if(!$user) {
        throw new Exception("Debe estar logueado para ejecutar esta accion");
    }
}

/**
* Garantiza que el usuario este logueado y que este sea owner
*de otra forma genera una excepcion.
*/
function owner_gatekeeper()
{
    $user = get_loggedin_user();
    if(!$user instanceof Owner) {
        throw new Exception("No tiene permisos para ejecutar esta accion");
    }
}

/**
 * Garantiza que el comando a ejecutar no se este haciendo desde la tablet 
 * Para acciones internas no relacionadas con la atencion al cliente
 */
function pos_gatekeeper()
{
    $userdata = $this->native_session->userdata();
    if(empty($userdata) || 
            !isset($userdata["location"])|| 
            $userdata["location"] != POS_LOCATION) {
        throw new Exception("Esta accion solo puede ejecutarse desde el punto de venta");
    }
}

/**
 * Verifica que el usuario sea root.
 */
function is_root(User $user)
{
    if($user instanceof Root) {
        return true;
    } else {
        return false;
    }
}

/**
 * Verifica que el usuario sea franquicia
 */
function is_franchise_user()
{
    if($user instanceof Franchise_User) {
        return true;
    } else {
        return false;
    }    
}