<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('wikiread');
    }

    function event($event_name, $start_year)
    {
        $url = urlencode($event_name);
        #$this->wikiread->get('Fifa');
        $this->wikiread->find('Fifa');
    }

    function suggest_event($event_name, $start_year)
    {
        $start_year = (int) $start_year;
        $event_name = urlencode($event_name);

        $this->wikiread->find($event_name, $start_year);
    }
}

