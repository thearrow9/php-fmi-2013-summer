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
}

