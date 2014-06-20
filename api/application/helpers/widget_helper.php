<?php

function showErrorMessage($message){
	echo '	<div class="ui-widget">
				<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
					<p style="padding: 10px 5px;"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
					<strong>Error:</strong> '.$message.'</p>
				</div>
			</div>';
}

function showAlertMessage($message){
	echo '	<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
					<p style="padding: 10px 5px;"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
					<strong>Alerta!</strong> '.$message.'</p>
				</div>
			</div>';
}


function notification($class, $messaage) {
	/*
	 * PARAM
	 * $class: .error, .warning, .success, .inforamtion
	 * $message: mensaje a mostrar.
	 */	
	echo '	<div class="'.$class.' grid_12">
				<h3>'.$messaage.'</h3>
				<a href="#" class="hide_btn">&nbsp;</a>
			</div>';	
}
