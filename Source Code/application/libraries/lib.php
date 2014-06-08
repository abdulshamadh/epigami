<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * Common library code for DB interaction.
	 * This library fuctions are tested with the Moodle 2.1.4+.
	 *
	 * @package Library
	 * @version 1.0
	 * @since 1.0
	 * @author Vignesh Gurusamy (vignesh@linkstreet.in)
	 */

	DEFINE('DEBUGMODE', 0);

	class Lib {

		protected $CFG;
		private $CI;

		/**
		 * Constructor class
		 */

		function __construct() {
			$this->CI =& get_instance();
			$this->CI->load->database();
		}

		/**
		 * Info function
		 * @param string type
		 * @return array
		 */

		function info($type) {
			$this->CI->db->select('variable,value');
			$this->CI->db->where('module',$type);
			$query = $this->CI->db->get('system_config');
			if ($query-> num_rows() > 0) {
				foreach ($query-> result_array() as $row => $value) {
					$data[$value['variable']] = $value['value'];
				}
			}
			return $data;
		}

		/**
		 * Log function
		 * @param string functionName
		 * @param string param
		 * @return int row[id]
		 */

		function log($functionName,$param=NULL) {
			//Transaction start
			$this->CI->db->trans_start();
			//Log insert
			$data = array("action"=>$functionName,"parameter"=>$param,"attempt"=>"1"); 
			$this->CI->db->set('created_at', 'NOW()', FALSE);
			$this->CI->db->insert('log_rest_call_status',$data);
			//Last entry
			$this->CI->db->select('LAST_INSERT_ID() AS id');
			$entry = $this->CI->db->get('log_rest_call_status');
			$rowid = $entry->row_array();
			//Transaction complete
			$this->CI->db->trans_complete();
			//Return
			return $rowid['id'];
		}

		/**
		 * Log status update
		 * @param string status
		 * @param int rowid
		 * @param string msg
		 * @return void
		 */

		function log_status_update($status,$rowid,$msg=NULL) {
			$data = array("status"=>$status,"error_info"=>$msg);
			$this->CI->db->where('id',$rowid);
			$this->CI->db->update('log_rest_call_status',$data);
		}

		/**
		 * Log recreate function is used to recreate the log action
		 * @param string functionName
		 * @param array param
		 * @param int rowid
		 * @return void
		 */

		function log_recreate($rowid,$functionName,$param) {
			//Transaction start
			$this->CI->db->trans_start();
			//Attempt check
			$this->CI->db->select('attempt');
			$this->CI->db->where('id',$rowid);
			$query = $this->CI->db->get('log_rest_call_status');
			$attempt = $query->row_array();
			//Log insert
			$data = array("action"=>$functionName,
				"parameter"=>$param,
				"previous_log"=>$rowid,
				"attempt"=>$attempt['attempt'] + 1);
			$this->CI->db->set('created_at', 'NOW()', FALSE);
			$this->CI->db->insert('log_rest_call_status',$data);
			//Transaction complete
			$this->CI->db->trans_complete();
		}

		/**
		 * Moodle settings
		 * @return void
		 */

		function moodle() {
			$module = "moodle";
			$response = $this->info($module);
			$this->CFG = (object)$response;
		}

		/**
		 * Webex settings
		 * @return void
		 */

		function webex() {
			$configName = "WEBEX";
			$this->info($configName);
		}

		/**
		 * Currency settings
		 * @return void
		 */

		function currency() {
			$this->CI->db->select('currency_iso');
			$this->CI->db->where('status',1);
			$result = $this->CI->db->get('currency_list');
			$i=0;
			foreach ($result->result() as $count) {
				foreach ($count as $currency_iso => $value) {
					$this->CFG->currency[$i] = $value;
					$i++;
				}
			}
		}

		/**
		 * Log response (If required)
		 * @param int rowid
		 * @param string response
		 * @return void
		 */

		/*function log_response($rowid,$response=NULL) {
			$data = array("response"=>$response);
			$this->CI->db->where('id',$rowid);
			$this->CI->db->update('log_rest_call_status',$data);
		}*/
	}

	/* End of file lib.php */

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
