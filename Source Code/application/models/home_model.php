<?php

class Home_model extends My_Model {

    function __construct() {
        parent::__construct();
    }

	function getPhonebook() {
    	$select = "SELECT id, name, phone_number, created_at FROM phonebook WHERE status = '0' ORDER BY id DESC";
        $query = $this->db->query($select);
        if ($query->result()) {
            $phonebook = $query->result();
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array('phonebook' => $phonebook)));
        } else {
            return array();
        }
    }
    
    function addContact($name, $phone_number) {
    	$data = array(
            'name' => $name,
            'phone_number' => $phone_number
        );
        if ($this->db->insert('phonebook', $data)) {
        	echo 'success';
        } else {
            return false;
        }
    }
    
    function delete_contact($phoneId) {
		if ($this->db->query("UPDATE phonebook SET status = '1' WHERE id='" . $phoneId . "'")) {
            echo 'success';
        } else {
            return false;
        }
    }
    
    function get_contact($phoneId) {
    	$select = "SELECT id, name, phone_number, created_at FROM phonebook WHERE id='" . $phoneId . "'";
        $query = $this->db->query($select);
        if ($query->result()) {
            $phonebook = $query->result();
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array('phonebook' => $phonebook)));
        } else {
            return array();
        }
    }
    
    function updateContact($phoneId, $name, $phone_number) {
    	if ($this->db->query("UPDATE phonebook SET name = '" . $name . "', phone_number = '" . $phone_number . "' WHERE id='" . $phoneId . "'")) {
            echo 'success';
        } else {
            return false;
        }
    }
    
    function getAllUsers() {
        $mysqlquery = "SELECT * FROM phonebook WHERE status = '0' ORDER BY id DESC";
        $result = $this->db->query($mysqlquery);
        return $result->result_array();
        
    }

}
