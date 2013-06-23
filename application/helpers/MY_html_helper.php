<?php if( ! defined('SITE_URL')) exit('No direct script access allowed');

if( ! function_exists('build_js_scripts'))
{
    function build_js_scripts($array = NULL)
    {
        if( ! count($array))
            return NULL;
        $html = NULL;

        foreach($array as $script)
            $html .= '<script type="text/javascript" src="' . SITE_URL . '/js/' . $script .'"></script>' . PHP_EOL;

        return $html;
    }
}

if( ! function_exists('build_css_links'))
{
    function build_css_links($array = NULL)
    {
        if( ! count($array))
            return NULL;
        $html = NULL;

        foreach($array as $css)
            $html .= '<link rel="stylesheet" type="text/css" href="' . SITE_URL . '/css/' . $css.'" />' . PHP_EOL;
        return $html;
    }
}
