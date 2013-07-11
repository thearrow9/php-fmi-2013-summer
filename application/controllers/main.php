<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    private $tmp_vars = array();

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->_set_defaults();
    }

    function index()
    {
        $data = array();
        $this->_push('html', $this->load->view('create', $data, TRUE));
        $this->_push('js', array('dev/wiki.js', 'dev/create_event.js'));
        $this->_push('css', array('template.css', 'form.css'));
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
        foreach((array)$value as $val)
            $this->tmp_vars[$array][] = $val;
    }
}

