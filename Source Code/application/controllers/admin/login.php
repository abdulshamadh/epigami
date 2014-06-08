<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Admin_Controller {

    //protected $contentdata;
    public function __construct() {
        parent::__construct();
        $this->load->helper(array("url", "form"));
        $this->load->model('generalcrud', '', true);
        if ($this->generalcrud->isloggedinadmin())
            redirect("index.php/admin/managedashboard");
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_username_chk');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        if ($this->form_validation->run() == FALSE) {
            //If failed
            $this->load->view('defaultadmin/default/login_template');
        } else {
            redirect('index.php/admin/managedashboard');
        }
    }

    public function check_database() {
        //Field validation succeeded.  Validate against database
        if ($this->input->post('username') && $this->input->post('password')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->generalcrud->VerifyAdmin($username, $password);
            //var_dump($result); exit;
            if (count($result) == 1) {
                $arr_usersessioninfo = array();
                foreach ($result as $row) {
                    $arr_usersessioninfo['user_id'] = $row->admin_id;
                    $arr_usersessioninfo['username'] = $row->username;
                    $arr_usersessioninfo['role_id'] = $row->role_id;
                    $arr_usersessioninfo['user_status'] = $row->user_status;
                    $this->session->set_userdata('loggedinadmindata', $arr_usersessioninfo);
                    $this->session->set_userdata('loggedinadmin', true);
                    //$_SESSION['authkey'] = $row->auth_key;
                }
                return true;
            } else {
                $this->form_validation->set_message('check_database', 'Invalid username or password');
                return false;
            }
        }
    }

    public function username_chk() {
        if (!$this->input->post('username')) {
            $this->form_validation->set_message('username_chk', 'The Username field is required.');
            return false;
        }
    }

}
