<?php 
	$success_message = $this->session->flashdata('success');
	if($success_message){
		echo '<div class="alert alert-success" role="success">', $success_message, '</div>';
	}
	$error_message = $this->session->flashdata('error');
	if($error_message){
		echo '<div class="alert alert-danger" role="alert">', $error_message, '</div>';
	}
?>
