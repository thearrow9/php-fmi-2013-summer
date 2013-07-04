<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('wiki');
        $this->load->model('mysqli_model');
    }

    function data($string = NULL)
    {
        echo $string;
    }

    function event()
    {
        $title = $this->input->post('title');
        $content = $this->_parse_wiki_content($this->wiki->get($title));
        echo $content;
    }

    function suggest_event()
    {
        $data = $this->input->post(NULL, TRUE);
        $responce = $this->wiki->find($data['start_year'] . ' ' . $data['name'], array('srlimit' => $data['srlimit']));

        $this->load->view('responces/create_event', array(
            'num_rows' => $data['srlimit'],
            'rows'     => $responce['query']['search']
        ));
        #$this->wiki->find((int) $start_year . $event_name);
    }

    private function _parse_wiki_content($data = array())
    {
        $content = $data['query']['page'];
    }
}

