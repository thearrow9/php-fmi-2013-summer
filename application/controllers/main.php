<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $tmp_vars = array();

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('form');
        $this->_set_defaults();
    }

    function form()
    {
        $data = array();
        $this->tmp_vars['html'] = $this->load->view('create', $data, TRUE);
        $this->_push('js', 'dev/wiki.js');
        $this->_push('js', 'dev/create_event.js');
        $this->_push('css', 'template.css');
        $this->_push('css', 'form.css');
        $this->_set_vars();
    }

    private function _set_defaults()
    {
        $this->tmp_vars['meta'] = array
        (
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'My Great Site'),
            array('name' => 'keywords', 'content' => 'love, passion, intrigue, deception'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        $this->tmp_vars['js'] = array('lib/jquery-2.0.2.min.js');
        $this->tmp_vars['css'] = array('reset.css');
        $this->tmp_vars['page_title'] = NULL;
    }

    private function _set_vars()
    {
        $this->load->view('template', $this->tmp_vars);
    }

    private function _push($array, $value)
    {
        $this->tmp_vars[$array][] = $value;
    }
}

