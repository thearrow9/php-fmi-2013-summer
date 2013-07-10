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

    function get_fifa_abbrs()
    {
        preg_match_all('#\{\{fb\|([A-Z]{3})\}\}#', $this->string, $matches, PREG_PATTERN_ORDER);
        return array_unique($matches[1]);
    }

    function get_teams_and_abbrs()
    {
        preg_match_all('#\[\[([A-Z][^\]\|\(]+)[\]\|\s].*\|\|[A-Z\s]*\|\|([A-Z]{3})\|\|#', $this->string, $matches);
        array_shift($matches);
        return $matches;
    }

    function find_more_teams()
    {
        #TODO soon;
    }

    function format_date($string, $year, & $start_date, & $end_date)
    {
        $parts = exlode('-', $string);
        $start_date = strtotime($parts[0] . ' ' . $year);
        $end_date = strtotime($parts[1] . ' ' . $year);
    }
}
