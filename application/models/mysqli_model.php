<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mysqli_model extends CI_Model
{
    private $CI;

    function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();

        if(empty($this->CI->db->conn_id))
            $this->CI->load->database();
    }

    function insert_event($data = array())
    {
        if( ! count($data))
            return FALSE;

        $sql = "INSERT INTO `events`
            (`name`, `start_date`, `end_date`, `type`, `running?`, `host_country`)
            VALUES
            (?, ?, ?, ?, ?, ?)";

        $this->CI->db->query($sql, $data);
    }

    function __destruct()
    {
        $this->CI->db->close();
    }
}
