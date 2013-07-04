<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mysqli extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        #var_dump($this->db->conn_id);
        #$this->load->database();
    }

    
}
