<?php
class my404 extends CI_Controller
{
	public function __construct()
	{
	        parent::__construct();
	}

	public function index()
	{
		$this->output->set_status_header('404');
		$data['content'] = 'error_404'; // View name
		
		
		$data['body_view'] = 'error404_view';
		$this->load->view('1columnlayout', $data);
	}
}
?>