<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    private $post_data = array();

    function __construct()
    {
        parent::__construct();
        $this->post_data = $this->input->post(NULL, TRUE);
        #$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        #if( ! count($this->post_data) OR ! $is_ajax)
        #{
        #    exit;
        #}

        $this->load->model('wiki');
        $this->load->model('wiki_text');
        $this->load->model('mysqli_model');
    }

    function insert_old_abbr()
    {
        if(empty($this->post_data['abbr']) or empty($this->post_data['name']))
        {
            echo -1;
            return;
        }
        echo $this->mysqli_model->insert_abbr($this->post_data);
    }

    function read_event()
    {
        $title = $this->post_data['title'];
        $year = $this->post_data['year'];
        $content = $this->wiki->get($title);
        $this->wiki_text->set_string($content);
        $abbrs = $this->wiki_text->get_fifa_abbrs();

        $this->wiki_text->format_date($this->wiki_text->get_item('dates'), $year, $start_date, $end_date);

        $teams = $this->mysqli_model->get_countries_by_abbr($abbrs);
        $optional_abbrs = $this->mysqli_model->find_new_abbrs($abbrs);
        $num_teams = $this->wiki_text->get_item('num_teams');

        if( ! is_numeric($num_teams))
        {
            $num_teams = count($teams) + count($optional_abbrs) . ' (?)';
        }

        $data = array(
            'title' => $title,
            'year' => $year,
            'host_country' => $this->wiki_text->get_item('country'),
            'champion' => $this->wiki_text->get_item('champion'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'num_teams' => $num_teams,
            'teams' => $teams,
            'num_found_teams' => count($teams),
            'num_opt_teams' => count($optional_abbrs)
        );

        $data['optional_abbrs'] = $optional_abbrs;
        if(count($data['optional_abbrs']))
        {
            $old_content = $this->wiki->get('Comparison of IOC, FIFA, and ISO 3166 country codes', array('section' => 1));
            $this->wiki_text->set_string($old_content);

            foreach($data['optional_abbrs'] as $old_name)
            {
                $data['suggestions'][] = $this->wiki_text->get_old_country_name($old_name);
            }
        }

        $this->load->view('responces/confirm_new_event', $data);
    }

    function suggest_event()
    {
        $responce = $this->wiki->find($this->post_data['start_year'] . ' ' . $this->post_data['name'],
            array('srlimit' => $this->post_data['srlimit']));

        $this->load->view('responces/create_event', array(
            'num_rows' => $this->post_data['srlimit'],
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
