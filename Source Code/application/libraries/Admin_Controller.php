<?php 
class Admin_Controller extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
        header('Pragma: no-cache'); // HTTP 1.0.
        header('Expires: 0');
		$this->load->model('generalcrud');
		
		$arr_exception_uris=array('admin/login', 'admin/logout');
		if (in_array(uri_string(), $arr_exception_uris) == FALSE) {
			if ($this->generalcrud->isloggedinadmin() == FALSE) {
				$this->session->set_userdata('redirect_url', current_url());
				redirect('index.php/admin/login');
			}
		}
	}
}