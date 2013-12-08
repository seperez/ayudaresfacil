<?php 	if($this->session->flashdata('msgError')) notification("error", $this->session->flashdata('msgError')) ;	if($this->session->flashdata('msgSuccess')) notification("success", $this->session->flashdata('msgSuccess')) ;	if($this->session->flashdata('msgInfo')) notification("information", $this->session->flashdata('msgInfo')) ;
?>
<div class="clear"></div>