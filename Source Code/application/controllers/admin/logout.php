<?php 
class Logout extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->session->unset_userdata('loggedinadmindata');
		$this->session->unset_userdata('loggedinadmin');
		$this->session->unset_userdata('redirect_url');
		redirect("index.php/admin/login","refresh");
	}
}