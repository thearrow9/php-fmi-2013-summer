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
        preg_match_all('#\{\{fb\|([A-Z]{3})#', $this->string, $matches, PREG_PATTERN_ORDER);
        return array_unique($matches[1]);
    }

    function get_teams_and_abbrs()
    {
        preg_match_all('#\[\[([A-Z][^\]\|\(]+)[\]\|\s].*\|\|[A-Z\s]*\|\|([A-Z]{3})\|\|#', $this->string, $matches);
        array_shift($matches);
        return $matches;
    }

    function format_date($string, $year, &$start_date, &$end_date)
    {
        preg_match_all('#(\d{1,2}\s[A-Z][a-z]+)#', $string, $matches, PREG_PATTERN_ORDER);

        $start_date = $matches[0][0]. ' ' . $year;
        $end_date = $matches[0][1] . ' ' . $year;
    }

    function parse_num_teams($string = NULL)
    {
        return $string;
        if(empty($string)) return 0;
        preg_match('#[1-3][0-9]#', $string, $matches);
        print_r($matches);
        return (int) $matches[1];
    }

    function get_old_country_name($abbr = NULL)
    {
        if(empty($abbr)) return FALSE;
        preg_match('#\|\{\{.*\[\[(.*)\]\].*' . $abbr . '.*#', $this->string, $matches);
        return count($matches) ? $matches[1] : NULL;
    }

    function get_event_name($string)
    {
        return trim(preg_replace('#\d{4}#', NULL, $string));
    }
}
