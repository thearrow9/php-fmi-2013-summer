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
            return 0;
        $teams = $data['teams'];
        unset($data['teams']);

        $data['start_date'] = $this->_time_to_sql_date($data['start_date']);
        $data['end_date'] = $this->_time_to_sql_date($data['end_date']);

        $data['host_country'] = $this->get_where('id', 'countries', 'name', $data['host_country']);
        $data['champion'] = $this->get_where('id', 'countries', 'name', $data['champion']);
        $data['num_teams'] = (int) $data['num_teams'];
        ksort($data);

        for ($i = 0; $i < $data['num_teams']; $i++)
        {
             $teams[$i] = $this->get_where('id', 'countries', 'name', $teams[$i]);
        }
        $sql = "
            INSERT INTO `events`
            (`champion`, `end_date`, `host_country`, `name`, `num_teams`, `start_date`)
            VALUES
            (?, ?, ?, ?, ?, ?)
            ";

        $this->CI->db->query($sql, $data);
        $this->_insert_participiants($teams, $this->CI->db->insert_id());
        return 1;
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

    private function _time_to_sql_date($time)
    {
        return date('Y-m-d', $time);
    }

    function get_where($what, $table, $col, $value)
    {
        $sql = $this->_select_from_where($what, $table, $col);
        $query = $this->CI->db->query($sql, $value);

        if( ! $query->num_rows()) return NULL;
        $result = $query->result_array();
        return $result[0][$what];
    }

    function __destruct()
    {
        $this->CI->db->close();
    }
    private function _insert_participiants($team_ids, $id)
    {
        $sql = "
            INSERT INTO `participation`
            (`event_id`, `team_id`) VALUES
            (?, ?)
            ";
        foreach($team_ids as $team_id)
        {
            $query = $this->CI->db->query($sql, array($id, $team_id));
        }
    }
}
