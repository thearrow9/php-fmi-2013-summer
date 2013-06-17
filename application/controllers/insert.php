<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert extends CI_Controller 
{
    private $url = array();
    private $replacements = array();

    public function __construct()
    {
        parent::__construct();

        $this->url['html_parser'] = APPPATH . 'third_party/html_parser';
        $this->load->add_package_path($this->url['html_parser']);
        require_once($this->url['html_parser'] . '/classes/html_dom_parser.php');
        $this->load->helper('htmlparser');

        $this->replacements = array
        (
            ' ' => '_'
        );
    }

    public function test()
    {
        $html = file_get_html('http://www.google.bg/');
        echo $html;
    }

    public function create_event($event_name, $start_year)
    {
        $url = $this->_wiki_string($event_name);
        $html = file_get_html('http://en.wikipedia.com/wiki/Special:Search/' . $start_year . '_' .  $url);
        #http://en.wikipedia.org/wiki/Special:Search/FIFA_WORLD_CUP
        $html->dump();
        #echo $html;
    }

    private function _wiki_string($string = NULL)
    {
        $string = urldecode($string);
        foreach ($this->replacements as $old => $new)
            $string = str_replace($old, $new, $string);

        return $string;
    }
}

