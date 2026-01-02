<?php 
    $this->load->view('template/header');
	$this->load->view('template/sidebar');
	$this->load->view('template/topbar');
	$this->load->view($contentView);
	$this->load->view('template/footer');
?>