<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageUsers extends Admin_Controller {

    function __contruct() {
        parent::__contruct();
    }

    function index() {
        $this->listusers();
    }

    function listusers($condition = 'all', $pageidval = 0, $limit = 10, $message = null) {

        $title = $this->lang->line('manage_users');
        $baseurl = base_url('index.php/admin/manageusers/listusers/all/');
        $totalrows = count($this->generalcrud->getadminallusers());
        $contentdata = $this->generalcrud->getadminuserpagination('all', $pageidval, $limit);
        switch ($condition) {
            case 'active' :
                $totalrows = count($this->generalcrud->getadminallusers(array('user_status' => 'active')));
                $contentdata = $this->generalcrud->getadminuserpagination(array('user_status' => 'active'), $pageidval, $limit);
                $baseurl = base_url('index.php/admin/manageusers/listusers/enabled/');
                break;
            case 'inactive' :
                $totalrows = count($this->generalcrud->getadminallusers(array('user_status' => 'inactive')));
                $contentdata = $this->generalcrud->getadminuserpagination(array('user_status' => 'inactive'), $pageidval, $limit);
                $baseurl = base_url('index.php/admin/manageusers/listusers/disabled/');
                break;
            case 'delete' :
                $totalrows = count($this->generalcrud->getadminallusers(array('user_status' => 'deleted')));
                $contentdata = $this->generalcrud->getadminuserpagination(array('user_status' => 'deleted'), $pageidval, $limit);
                $baseurl = base_url('index.php/admin/manageusers/listusers/disabled/');
                break;
            default:
                break;
        }
        $this->load->library('pagination');
        $config = array(
            'base_url' => $baseurl,
            'uri_segment' => 5,
            'total_rows' => $totalrows,
            'per_page' => $limit,
            'full_tag_open' => '<div class="pagination"><ul>',
            'full_tag_close' => '</ul></div>',
            'num_tag_open' => "<li>",
            'num_tag_close' => "</li>",
            'next_link' => 'Next &rsaquo;',
            'next_tag_open' => "<li>",
            'next_tag_close' => "</li>",
            'prev_link' => '&lsaquo; Prev',
            'prev_tag_open' => "<li>",
            'prev_tag_close' => "</li>",
            'cur_tag_open' => "<li class='active'><a href='#'>",
            'cur_tag_close' => "</a></li>",
            'last_tag_open' => "<li>",
            'last_tag_close' => "</li>",
            'first_tag_open' => "<li>",
            'first_tag_close' => "</li>");
        $this->pagination->initialize($config);
        $paginationdata = $this->pagination->create_links();
        $this->load->view('defaultadmin/default/page_template', array("subview" => "defaultadmin/default/subviews/listusers", "contentdata" => $contentdata, "message" => $message, "title" => $title, "paginationdata" => $paginationdata, 'activemenu' => 'listusers'));
    }
    
    function deleteuser($id = null) {
        $message = null;
        if ($id == null)
            redirect('index.php/admin/manageusers/listusers');
        else {
            $arr_update = array('user_status' => 'deleted');
            $where = 'admin_id=' . $id;
            if ($this->generalcrud->updateadminuser($arr_update, $where))
                $message = "Admin User Deleted Successfully";
            $this->listusers('all', 0, 10, $message);
        }
    }
    
    function adminuser_add() {
        $title = $this->lang->line('adminuser_add');
        $contentdata = null;
        $message = null;
        $error = null;
        if ($this->input->post('name') && $this->input->post('email') && $this->input->post('user_name') && $this->input->post('password')) {
            $encryptionkey = config_item('encryption_key');
            $password = $this->input->post('password');
            $data = array(
                'firstname' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('user_name'),
                'password' => $this->generalcrud->encrypt($password, $encryptionkey),
                'role_id' => $this->input->post('role'),
                'user_status' => $this->input->post('status'),
                'created_at' => date('Y-m-d H:i:s'));
           
            $res_user_id = $this->generalcrud->adminuser_add($data);
            //echo $res_user_id; exit;
            if ($res_user_id) {
                $message = "New user created successfully";
            } else {
                $error = "Sorry, unable to create this user";
            }
        }
        $this->load->view('defaultadmin/default/page_template', array("subview" => "defaultadmin/default/subviews/adminuser_add", "contentdata" => $contentdata, "message" => $message, "title" => $title, "error" => $error, "activemenu" => "adminuser_add"));
    }
    
    function adminuser_edit($id = null) {
        
        $title = $this->lang->line('adminuser_edit');
        $contentdata = null;
        $message = null;
        $error = null;
        if ($this->input->post('admin_id') && $this->input->post('name') && $this->input->post('email') && $this->input->post('user_name')) {
            $encryptionkey = config_item('encryption_key');
            $password = $this->input->post('password');
            if($password!=""){
            $data = array(
                'firstname' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('user_name'),
                'password' => $this->generalcrud->encrypt($password, $encryptionkey),
                'role_id' => $this->input->post('role'),
                'user_status' => $this->input->post('status'),
                'created_at' => date('Y-m-d H:i:s'));
            } else {
            $data = array(
                'firstname' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('user_name'),
                'role_id' => $this->input->post('role'),
                'user_status' => $this->input->post('status'),
                'created_at' => date('Y-m-d H:i:s'));
            }
            if ($this->generalcrud->adminuser_edit($data, $this->input->post('admin_id'))){
                $message = "User created successfully";
            } else {
                $error = "Sorry, unable to update this user";
            }
        }
        if (!preg_match('/^\d+$/', $id))
            redirect("index.php/admin/manageitems/listusers");
        $dataforid = $this->generalcrud->getadminallusers($id);
       
        $contentdata = array('dataforid' => $dataforid, 'alldata' => $alldata);
        $this->load->view('defaultadmin/default/page_template', array("subview" => "defaultadmin/default/subviews/adminuser_edit", "contentdata" => $contentdata, "message" => $message, "title" => $title, "error" => $error, 'activemenu' => 'listusers'));
    }

    function changeadminpasswd() {

        if (isset($_GET["changepassword"]) && $_GET["changepassword"] == 'success') {
            $msg = "Your password has been changed successfully.";
            $message = "Changed";
        }
        $paginationdata = $message = $contentdata = null;
        $title = $this->lang->line('change_admin_password');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('admincpasswd', 'Current Password', 'trim|required|min_length[5]|max_length[15]|is_unique[admin_user.password]');
        $this->form_validation->set_rules('adminnpasswd', 'New Password', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('adminnnpasswd', 'Retype New Password', 'trim|required|min_length[5]|max_length[15]|matches[adminnpasswd]');
        if ($this->form_validation->run() == FALSE) {
            //$msg = "Something Went Wrong, Password Not Changed";
            $this->load->view('defaultadmin/default/page_template', array("subview" => "defaultadmin/default/subviews/changepasswd", "contentdata" => $contentdata, "message" => $message, "title" => $title, "paginationdata" => $paginationdata, 'activemenu' => 'change_passwd'));
        } else {
            $get_admin_session_data = $this->session->all_userdata();
            $get_admin_user_id = $get_admin_session_data['loggedinadmindata']['user_id'];
            $get_admin_user_status = $get_admin_session_data['loggedinadmindata']['user_status'];

            if ($get_admin_user_id != 1 && $get_admin_user_status == 'active') {
                $this->session->set_userdata('redirect_url', current_url());
                redirect('index.php/admin/login');
            } else {
                $contentdata = $this->generalcrud->changeadminpasswdbyadmin($get_admin_user_id, $get_admin_user_status);
                if ($contentdata) {
                    $message = "Password changed successful";
                } else {
                    $message = "Something Went Wrong, Password Not Changed";
                }
                $this->load->view('defaultadmin/default/page_template', array("subview" => "defaultadmin/default/subviews/changepasswd", "contentdata" => $contentdata, "message" => $message, "title" => $title, "paginationdata" => $paginationdata, 'activemenu' => 'change_passwd'));
            }
        }
    }
    
    

}
