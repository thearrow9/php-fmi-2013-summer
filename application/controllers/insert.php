<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('wikiread');
    }

    function event($title)
    {
        $this->wikiread->get('2010 FIFA World Cup');
    }

    function suggest_event($event_name, $start_year)
    {
        $this->wikiread->find((int) $start_year . $event_name);
    }
}

