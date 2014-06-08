<?php 

/**
* 
*/
class Frontend_Controller extends MY_Controller {	

	function __construct() {
		parent::__construct();
		//session_start(); 
		$this->lang->load("title","english");
		$this->load->helper('breadcrumb_helper');				
	}
}