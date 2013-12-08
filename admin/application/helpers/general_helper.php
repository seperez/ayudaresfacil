<?php

function ma($array, $die = 0){
	//IMPRIME EN PANTALLA UN ARRAY FORMATEADO
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	if($die == 1) die(); 
}

function renderSelectOptions($arrOptions, $selectedId = 0){
	foreach ($arrOptions as $option){
		if($selectedId == $option->id) $selected="selected";
		else $selected="";
		echo '<option value="'.$option->id.'" '.$selected.'>'.$option->descripcion.'</option>';
		//echo '<option value="'.$option->id.'" '.set_select($selectName, $category->id).'>'.$category->name.'</option>';
	}
}

function renderSelectOptionsByName($arrOptions, $selectedId = 0){
	foreach ($arrOptions as $option){
		if($selectedId == $option->id) $selected="selected";
		else $selected="";
		echo '<option value="'.$option->id.'" '.$selected.'>'.$option->nombre.'</option>';
	}
}

function getImgSrc($img,$path,$thumb = FALSE){
	$error = FALSE;	
	if(isset($img) && strlen($img)>0){
		if(file_exists($path.trim($img))){
			if($thumb) $img = getThumbName($img);	
			$imgSrc = $path.trim($img);
		}else $error = TRUE; 
	}else $error = TRUE;

	if($error){
		if($thumb)$imgSrc = base_url().'data/images/sinImagen_thumb.jpg';
		else $imgSrc = base_url().'data/images/sinImagen.jpg';
	}
	
	return $imgSrc;
}

function getThumbName($img){
	$aux = array_reverse(explode(".", $img));
	if($aux[0] == "jpg") $img = str_replace(".jpg", "_thumb.jpg",$img);
	elseif($aux[0] == "png") $img = str_replace(".png", "_thumb.png",$img);
	elseif($aux[0] == "gif") $img = str_replace(".gif", "_thumb.gif",$img);
	return $img;
}

function convertDecimalToDataBaseFormat($decimal){
	return str_replace(',', '.', $decimal);		
}

function convertDecimalToUserFormat($decimal){
	return str_replace('.', ',', $decimal);	
}