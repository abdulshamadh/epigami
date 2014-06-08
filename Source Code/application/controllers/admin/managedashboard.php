<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ManageDashboard extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('language');
    }

    function index()
    {
        $contentdata = $message = $paginationdata = null;
        $title = $this->lang->line("admin_dashboard");
        $this->load->model('generalCrud');
		$user_id = $this->session->userdata('loggedinadmin');
		$getAuthkey = $this->generalCrud->getUserAuthkey($user_id);
		$authkey = $getAuthkey->auth_key;
        $this->load->view('defaultadmin/default/page_template', array("subview" => "defaultadmin/default/subviews/home", "contentdata" => $contentdata, "message" => $message, "title" => $title, "paginationdata" => $paginationdata, "authkey" => $authkey, 'activemenu' => 'home'));
    }
}