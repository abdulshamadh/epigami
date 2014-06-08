<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GeneralCrud extends CI_Model {

    public function CreateUserAdmin($data) {
        if ($this->db->insert("admin_user", $data))
            return true;
        return false;
    }

    public function VerifyAdmin($username, $password) {
        
        $encryptionkey = $this->config->item("encryption_key");
        $mysqlquery = "SELECT * from admin_user where (role_id = 1 or role_id = 2) and username = ? and password = ? and user_status = ?";
        $results = $this->db->query($mysqlquery, array($username, $this->encrypt($password, $encryptionkey), "active"));
        return $results->result();
    }
    
    function getUserAuthkey($user_id) {
        $mysqlquery = "SELECT auth_key from `admin_user` where `admin_id` = '$user_id'";
        $results = $this->db->query($mysqlquery);
        return $results->row();
    }
    
    private function getlast_insert_id() {
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }

    function changeadminpasswdbyadmin($admin_id, $user_status) {
        $encrypt_key = config_item('encryption_key');
        $admincpass = $this->encrypt($this->input->post('admincpasswd'), $encrypt_key);
        $adminnpass = $this->input->post('adminnpasswd');
        $this->db->where('admin_id', $admin_id);
        $this->db->where('user_status', $user_status);
        $userPasswd = $this->db->get("admin_user")->row()->password;
        if ($userPasswd === $admincpass) {
            $data = array(
                'password' => $this->encrypt($adminnpass, $encrypt_key)
            );
            $this->db->where('admin_id', $admin_id);
            $this->db->where('user_status', 'active');
            $this->db->update('admin_user', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
      @return: true if admin is logged in
     */

    public function isloggedinadmin() {
        return (bool) $this->session->userdata('loggedinadmin');
    }


    function start_transac() {
        $this->db->trans_start();
    }

    function stop_transac() {
        $this->db->trans_complete();
    }

    
    function checkEmailUnique($email) {
        $mysqlquery = "SELECT * FROM `user` where email = ?";
        $result = $this->db->query($mysqlquery, $email);
        return $result->result_array();
    }

    function checkUsernameUnique($username) {
        $mysqlquery = "SELECT * FROM `user` where username = ?";
        $result = $this->db->query($mysqlquery, $username);
        return $result->result_array();
    }

    public function encrypt($data, $key) {
        $encrypted_text = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted_text;
    }

    public function decrypt($data, $key) {
        $decrypted_text = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted_text;
    }

    
    function getadminallusers($condition = null) {
        if ($condition == null) {
            $mysqlquery = "SELECT * from `admin_user` "; //where `visibility` = 'enabled' 
            $results = $this->db->query($mysqlquery);
            return $results->result();
        } elseif (is_array($condition)) {
            $mysqlquery = "SELECT * from `admin_user` where ";
            $whereauto = implode($this->db->where($condition)->ar_where, ' ');
            $finalquery = $mysqlquery . $whereauto;
            $results = $this->db->query($finalquery);
            return $results->result();
        } else {
            $mysqlquery = "SELECT * from `admin_user` where admin_id=? ";
            $results = $this->db->query($mysqlquery, $condition);
            return $results->result();
        }
    }

    function getadminuserpagination($where = 'all', $start = 0, $limit = 10) {
        if ($where == 'all') {
            $mysqlquery = "SELECT * from `admin_user` limit " . $start . "," . $limit;
            $results = $this->db->query($mysqlquery);
            return $results->result();
        } elseif (is_array($where)) {
            $mysqlquery = "SELECT * from `admin_user` where ";
            $whereauto = implode($this->db->where($where)->ar_where, ' ');
            $finalquery = $mysqlquery . $whereauto . " limit " . $start . "," . $limit;
            $results = $this->db->query($finalquery);
            return $results->result();
        }
    }
    
    public function updateadminuser($insertdata, $where) {
        $update_str = $this->db->update_string('admin_user', $insertdata, $where);
        return (bool) $this->db->query($update_str);
    }
    
    function adminuser_add($arr_data) {
        $insert_str = $this->db->insert_string('admin_user', $arr_data);
        //echo $this->db->query($insert_str); exit;
        if ((bool) $this->db->query($insert_str)) {
            return $this->getlast_insert_id();  
        }
    }
    
    function adminuser_edit($arr_data, $whereid) {
        $whereid = 'admin_id=' . $whereid;
        $update_str = $this->db->update_string('admin_user', $arr_data, $whereid);
        return (bool) $this->db->query($update_str);
    }

}

?>