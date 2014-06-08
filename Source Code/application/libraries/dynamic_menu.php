<?php

class Dynamic_menu extends MY_Controller{

    function __construct() {
        $this->ci =& get_instance(); // get a reference to CodeIgniter.
	}
	
	function show_menu(){
  		
		$obj =& get_instance();
		$query = $this->ci->db->query("SELECT name FROM category WHERE parent_id = 0 AND category_id != 1");
		//var_dump($query->result_array());
		
		$menu = '<div class="navbar">';
		$menu .= '<div class="navbar-inner">';
		$menu .= '<ul class="nav">';
		foreach($query->result_array() as $menus) {
		$menu .= '<li>';
		$menu .= '<a href="#">'.$menus['name'].'</a>';
		$menu .= '</li>';
		}
		$menu .= '</ul>';
		$menu .= '</div>';
		$menu .= '</div>';
		
  		return $menu;
 	}
	
	function load_footer() {
		$data = array();
		$footerobj =& get_instance();
		$query = $this->ci->db->query("SELECT page_content FROM pages WHERE page_status = 'active' AND page_slug = 'about-us'");
		if ($query-> num_rows() > 0) {
			foreach ($query-> result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}
}