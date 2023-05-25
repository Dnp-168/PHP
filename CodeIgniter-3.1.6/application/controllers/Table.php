<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {
    public function index() {
        $data['countries'] = array(
            array(
                'country' => 'USA',
                'states' => array('California', 'Florida', 'New York'),
                'price' => 10
            ),
            array(
                'country' => 'Canada',
                'states' => array('Ontario', 'Quebec', 'Alberta'),
                'price' => 8
            )
        );

        $this->load->helper('form');
        $this->load->view('dynamic_table', $data);
    }
}
?>