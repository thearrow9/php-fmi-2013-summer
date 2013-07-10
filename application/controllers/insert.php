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
        $year = $this->input->post('year');
        $content = $this->wiki->get($title);
        $this->wiki_text->set_string($content);
        $abbrs = $this->wiki_text->get_fifa_abbrs();

        $data = array(
            'title' => $title,
            'year' => $year,
            'host_country' => $this->wiki_text->get_item('country'),
            'champion' => $this->wiki_text->get_item('champion'),
            'dates' => $this->wiki_text->get_item('dates'),
            'num_teams' => $this->wiki_text->get_item('num_teams'),
            'teams' => $this->mysqli_model->get_countries_by_abbr($abbrs)
        );

        if(count($data['teams']) < $data['num_teams'])
        {
            $data['optional_abbrs'] = $this->mysqli_model->find_new_abbrs($abbrs);
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
    }

    function update_nations()
    {
        $content = $this->wiki->get('Comparison of IOC, FIFA, and ISO 3166 country codes', array('section' => 0));
        $this->wiki_text->set_string($content);
        echo $this->mysqli_model->rewrite_countries($this->wiki_text->get_teams_and_abbrs());
   }


}

