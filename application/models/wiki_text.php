<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wiki_text
{
    private $string = NULL;
    private $basic_pattern = '\s*=\s*(.*)\s*\|';

    function __construct()
    {
    }

    function set_string($string = NULL)
    {
        $this->string = $string;
    }

    function get_item($item = NULL)
    {
        preg_match('#' . $item . $this->basic_pattern . '#', $this->string, $matches);
        return count($matches) ? $matches[1] : NULL;
    }

    function get_teams()
    {
        preg_match_all('#\{\{fb\|([^\}]{4,})\}\}#', $this->string, $matches, PREG_PATTERN_ORDER);
        return array_unique($matches[1]);
    }

    function find_more_teams()
    {
        #TODO soon;
    }
}
