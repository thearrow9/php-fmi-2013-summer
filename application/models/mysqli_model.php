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

        $sql = "
            INSERT INTO `events`
            (`name`, `start_date`, `end_date`, `type`, `running?`, `host_country`)
            VALUES
            (?, ?, ?, ?, ?, ?)
            ";

        $this->CI->db->query($sql, $data);
    }

    function rewrite_countries($data = array())
    {
        $records = count($data[0]);

        $this->_foreigner_key(FALSE);
        $this->CI->db->query('TRUNCATE TABLE `countries`');

        $sql = "
            INSERT INTO `countries`
            (`name`, `abbr`) VALUES
            (?, ?)
            ";

        $success_queries = 0;

        for($i = 0; $i < $records; $i++)
        {
            if($this->CI->db->query($sql, array($data[0][$i], $data[1][$i])))
                $success_queries++;
        }

        $this->_foreigner_key(TRUE);
        return $success_queries;
    }

    function get_countries_by_abbr($abbrs = array())
    {
        $records = count($abbrs);
        if( ! $records) return array();

        $sql = $this->_select_from_where('name, abbr', 'countries', 'abbr') . str_repeat("OR `abbr` = ?", $records - 1);

        $query = $this->CI->db->query($sql, $abbrs);

        if( ! $query->num_rows()) return NULL;
        return $query->result_array();
    }

    function get_country($abbr = NULL)
    {
        if(empty($abbr)) return NULL;

        $sql = $this->_select_from_where('name', 'countries', 'abbr');

        $query = $this->CI->db->query($sql, $abbr);

        if( ! $query->num_rows()) return NULL;
        return $query->result_array();
    }

    function get_abbr($name = NULL)
    {
        if(empty($name)) return NULL;

        $sql = $this->_select_from_where('abbr', 'countries', 'name');

        $query = $this->CI->db->query($sql, $name);

        if( ! $query->num_rows()) return NULL;
        return $query->result_array();
    }

    function find_new_abbrs($abbrs = array())
    {
        $result = array();
        foreach($abbrs as $value)
        {
            if($this->get_country($value) == NULL)
                $result[] = $value;
        }
        return $result;
    }

    function insert_in_country($data = array())
    {
        if($this->get_abbr($data['name']) != NULL or $this->get_country($data['abbr']) != NULL)
            return -1;

        $sql = "
            INSERT INTO `countries`
            (`abbr`, `name`) VALUES
            (?, ?)
            ";
        return 1;
        $this->CI->db->query($sql, $data);
        return $this->CI->db->affected_rows();
    }

    private function _select_from_where($col, $table, $col_where)
    {
        return "
            SELECT $col
            FROM `$table`
            WHERE `$col_where` = ?
            ";
    }
    private function _foreigner_key($status = TRUE)
    {
        $this->CI->db->query('SET FOREIGN_KEY_CHECKS=' . (int) $status);
    }

    function __destruct()
    {
        $this->CI->db->close();
    }
}
