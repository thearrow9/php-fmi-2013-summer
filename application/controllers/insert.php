<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller 
{
    private $url = array();

    public function __construct()
    {
        parent::__construct();
        $this->url['html_parser'] = APPPATH . 'third_party/html_parser';
        $this->load->add_package_path($this->url['html_parser']);
        require_once($this->url['html_parser'] . '/classes/html_dom_parser.php');
        $this->load->helper('htmlparser');
    }

    public function test()
    {
        $html = file_get_html('http://www.google.bg/');
        echo $html;
    }
}

