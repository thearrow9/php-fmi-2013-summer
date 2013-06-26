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
        $data = $this->input->post(NULL, TRUE);
        $responce = $this->wiki->find($data['start_year'] . ' ' . $data['event_name'], array('srlimit' => $data['limit']));

        $this->load->view('responces/create_event', array(
            'num_rows' => $data['limit'],
            'rows'     => $responce['query']['search']
        ));
        #$this->wiki->find((int) $start_year . $event_name);
    }
}

