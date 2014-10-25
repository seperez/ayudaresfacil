<?php
	function checkIsLoggedIn($self){
		if(!CI_Auth::isLoggedIn($self->get('token')))
			$self->response(array('status' => 'UNAUTHORIZED'), 401);		
	}
?>