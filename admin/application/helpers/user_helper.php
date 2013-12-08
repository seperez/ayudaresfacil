<?php

function isLoggedIn() {
	$CI =& get_instance();
	$id = $CI->native_session->userdata('userId');
	if(!empty($id)) {
		return true;
	} else {
		return false;
	}
}

function checkLogin(){
	$currentUrl = str_replace("http://", "", current_url());

	if(	current_url() != (base_url()."admin/recoverPassword") && 
		current_url() != (base_url()."admin") && 
		current_url() != (base_url()."admin/index") && 
		current_url() != base_url() && 
		current_url() != (base_url()."admin/login")
		
	){
		if(!isLoggedIn()){
			redirect(base_url()."admin/index");
		}
	}
}

function setSessionData($user) {
	$CI =& get_instance();
	$userdata = array(
		'userId' => $user->getId(),
		'username' => $user->getUsername(),
		'roleId' => $user->getRoleId()
	);	
	$CI->native_session->set_userdata($userdata);
}

function logout() {
	$CI =& get_instance();
	$CI->native_session->destroy();
}

/**
 * Obtiene la instancia del usuario logueado 
 */
function getLoggedinUser() {
	$CI =& get_instance();
	return CI_User::getById($CI->native_session->userdata('userId'));
}

/**
 * Obtiene el roleId del usuario logueado 
 */
function getRoleId() {
	$CI =& get_instance();
	return $CI->native_session->userdata('roleId');
}

/**
 * Obtiene la descripcion del roleId del usuario logueado 
 */
function getRoleDescription($roleId) {
	$CI =& get_instance();
	$role = $CI->user_model->getUserRoleById($roleId);
	return $role[0];
}

function isAllowedSection($section){
	$return = FALSE;	
	$CI =& get_instance();
	$roleId = $CI->native_session->userdata('roleId');
	
	//PERMISOS DE LOS USUARIOS
	//Admin
	$arrAdminSectionPermmissions = array('welcome','user');
	
	//CRONISTA
	$arrInvitedSectionPermmissions = array('welcome');
	
	//SETEO LOS PERMISOS DEL USUARIO Y LOS GUARDO EN UNA CONSTANTE
	$arrPermissions = array();
	if($roleId == 1) $arrPermissions = $arrEditorSectionPermmissions;
	elseif($roleId == 2) $arrPermissions = $arrCronistSectionPermmissions;
			
	if(in_array($section, $arrPermissions)) $return = TRUE;
	
	return $return;
}
