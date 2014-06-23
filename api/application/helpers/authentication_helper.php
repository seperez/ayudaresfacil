<?php
	function checkIsLoggedIn($self){
		if(!CI_Authentication::isLoggedIn($self->get('token')))
			$self->response(array('status' => 'UNAUTHORIZED'), 401);		
	}
?>