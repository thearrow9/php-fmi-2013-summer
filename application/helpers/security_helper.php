<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! (function_exists('filter_post_var')))
{
    function filter_post_var($var)
    {
        if(is_array($var)) return $var;
        #{
        #    foreach($var as $value)
        #        filter_post_var($value);
        #    return;
        #}
        echo var_dump($var);

        if(empty($var)) return NULL;

        $var = trim($var);
        $var = preg_replace('/\s\s+/', ' ', $var);
        $var = mysql_real_escape_string($var);
        $var = htmlspecialchars($var, ENT_IGNORE, 'utf-8');
        $var = strip_tags($var);
        $var = stripslashes($var);

        return $var;
    }
}

