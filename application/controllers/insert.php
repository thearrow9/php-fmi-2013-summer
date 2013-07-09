<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('wiki');
        $this->load->model('wiki_text');
        $this->load->model('mysqli_model');
    }

    function data($string = NULL)
    {
        echo $string;
    }

    function event()
    {
        $title = $this->input->post('title');
        $content = $this->wiki->get($title);
        $this->wiki_text->set_string($content);
        $data = array(
            'title' => $title,
            'host_country' => $this->wiki_text->get_item('country'),
            'champion' => $this->wiki_text->get_item('champion'),
            'dates' => $this->wiki_text->get_item('dates'),
            'num_teams' => $this->wiki_text->get_item('num_teams'),
            'teams' => $this->wiki_text->get_teams()
        );

        if(count($data['teams']) < $data['num_teams'])
        {
            $data['optional_teams'] = $this->wiki_text->find_more_teams();
            echo $content;
        }

        $this->load->view('responces/confirm_new_event', $data);
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

    function update_nations()
    {
        print_r($this->wiki->get('Comparison of IOC, FIFA, and ISO 3166 country codes'));
    }


}

