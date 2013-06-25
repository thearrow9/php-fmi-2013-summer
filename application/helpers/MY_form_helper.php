<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! (function_exists('build_datalist')))
{
    function build_datalist($element_id, $options = array())
    {
        $open_tag = "<datalist id=\"{$element_id}\">";
        $close_tag = "</datalist>";
        if( ! count($options))
            return $open_tag . $close_tag . PHP_EOL;

        $html = NULL;
        foreach($options as $option)
            $html .= "<option value=\"{$option}\">" . PHP_EOL;

        return $open_tag . PHP_EOL . $html . PHP_EOL . $close_tag . PHP_EOL;
    }
}

