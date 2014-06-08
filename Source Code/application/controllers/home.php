<?php

class Home extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("pagination");
        if ($this->uri->segment(3) != NULL) {
            $uriii = $this->uri->segment(3);
        }
    }

    function index($export='') {
        
        
        if(isset($export) && $export=='export'){
        $returnarray = array();
        $allusers = $this->home_model->getAllUsers();
        foreach ($allusers as $values) {
            array_push($returnarray, $values);
        }
                        $alphas = range('A', 'Z');
                        $this->load->library('excel');
                        $this->excel->setActiveSheetIndex(0);
                        $this->excel->getActiveSheet()->setTitle('User Details');
                        //$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
                        $fields = $this->db->list_fields('phonebook');
                        $increment = 0;
                        foreach ($fields as $field) {
                            $this->excel->getActiveSheet()->setCellValue($alphas[$increment] . 1, $field);
                            $increment++;
                        }
                        $increment = 2;
                        $rowincrement = 0;
                        foreach ($returnarray as $returnvalue) {
                            foreach ($returnvalue as $subreturn) {
                                $this->excel->getActiveSheet()->setCellValue($alphas[$rowincrement] . $increment, $subreturn);
                                $rowincrement++;
                            }
                            $rowincrement = 0;
                            $increment++;
                            //echo "<br /> ******************************<br />";
                        }
                        $filename = 'Phonebook_Contacts.xls'; //save our workbook as this file name
                        header('Content-Type: application/vnd.ms-excel'); //mime type
                        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
                        header('Cache-Control: max-age=0'); //no cache		 
                        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                        //if you want to save it as .XLSX Excel 2007 format
                        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                        //force user to download the Excel file without writing it to server's HD
                        $objWriter->save('php://output');
        }
        
        $data['body_view'] = 'home';
        $this->load->view('columnlayout', $data);
    }
    
    function getPhonebook() {
    	$data['phonebook'] = $this->home_model->getPhonebook();
    }
    
    function addContact() {
        $name = $_REQUEST['name'];
        $phone_number = $_REQUEST['phone_number'];
        $data['result'] = $this->home_model->addContact($name, $phone_number);
    }
    
    function delete_contact() {
        $phoneId = $_REQUEST['phoneId'];
        $data['result'] = $this->home_model->delete_contact($phoneId);
    }

    function get_contact() {
    	$phoneId = $_REQUEST['phoneId'];
    	$data['get_contact'] = $this->home_model->get_contact($phoneId);
    }
    
    function updateContact() {
    	$phoneId = $_REQUEST['phoneId'];
    	$name = $_REQUEST['name'];
        $phone_number = $_REQUEST['phone_number'];
        $data['result'] = $this->home_model->updateContact($phoneId, $name, $phone_number);
    }
    
    
}
