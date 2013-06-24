<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('wiki');
    }

    function event($title)
    {
        $this->wiki->get($title);
    }

    function suggest_event()
    {
        print_r($this->input->post(NULL, TRUE));
        #$this->wiki->find((int) $start_year . $event_name);
    }
}

