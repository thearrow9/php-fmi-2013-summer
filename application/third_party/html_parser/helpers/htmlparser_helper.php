<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('file_get_html'))
{
    function file_get_html($url, $use_include_path = false, $context = null, $offset = -1, $maxLen=-1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT)
    {
        // We DO force the tags to be terminated.
        $dom = new simple_html_dom(null, $lowercase, $forceTagsClosed, $target_charset, $defaultBRText);
        // For sourceforge users: uncomment the next line and comment the retreive_url_contents line 2 lines down if it is not already done.
        $contents = file_get_contents($url, $use_include_path, $context, $offset);
        // Paperg - use our own mechanism for getting the contents as we want to control the timeout.
        //    $contents = retrieve_url_contents($url);
        if (empty($contents))
        {
            return false;
        }
        // The second parameter can force the selectors to all be lowercase.
        $dom->load($contents, $lowercase, $stripRN);
        return $dom;
    }
}

// get html dom from string

if( ! function_exists('str_get_html'))
{
    function str_get_html($str, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT)
    {
        $dom = new simple_html_dom(null, $lowercase, $forceTagsClosed, $target_charset, $defaultBRText);
        if (empty($str))
        {
            $dom->clear();
            return false;
        }
        $dom->load($str, $lowercase, $stripRN);
        return $dom;
    }
}

// dump html dom tree
if( ! function_exists('dump_html_tree'))
{
    function dump_html_tree($node, $show_attr = true, $deep = 0)
    {
        $node->dump($node);
    }
}
