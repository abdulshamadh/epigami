<?php

$this->load->view('defaultadmin/default/subviews/header');
$this->load->view('defaultadmin/default/subviews/sidebar',array('activemenu'=>$activemenu));
$this->load->view($subview,array("contentdata"=>$contentdata));
$this->load->view('defaultadmin/default/subviews/footer');