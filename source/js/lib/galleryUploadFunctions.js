var upload_number = 0;
var cantImagenes = 0;
var maxCantImagenes = 0;
function addFileInput() {
	if((maxCantImagenes - cantImagenes) > 0) {
		var outHTML = "<div class='form_row' id='row_" + upload_number + "'><div title='Quitar' class='ui-state-default ui-corner-all' style='width:16px;cursor:pointer;display:inline-block;margin:0 10px -4px 0;' onclick=removeFileInput('row_" + upload_number + "') ><span class='ui-icon ui-icon-circle-close'></span></div><input type='file' name='userfile_" + upload_number + "'/></div>"
		$('#masUploads').append(outHTML);
		upload_number++;
		cantImagenes++;
	} else {
		alert("Solo se permite cargar " + maxCantImagenes + " imagenes. Si desea modificar una de ellas primero eliminela y luego cargue una nuevamente.");
	}
}

function removeFileInput(id) {
	if($('#' + id)){
		$('#' + id).remove();
		upload_number--;
		cantImagenes--;
	}
}

function deleteImage(url) {
	$.ajax({
		data : "",
		type : "GET",
		dataType : "json",
		url : url,
		success : function(data) {
			if(!data) alert(data);
			else cantImagenes--;
		}
	});
}