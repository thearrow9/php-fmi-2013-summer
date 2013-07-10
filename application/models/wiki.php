<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wiki extends CI_Model
{
    private $host_api;
    private $host_content;
    private $options = array();
    private $params = array();

    function __construct()
    {
        parent::__construct();
        $this->host_api = 'http://wikipedia.org/w/api.php?';
        $this->host_content = 'http://en.wikipedia.org/w/index.php?';
        $this->options = array
        (
            'redirect' => 5
        );

        $this->params = array
        (
            'format' => 'json',
            'action' => 'query'
        );
    }

    function find($string, $params = array())
    {
        $params = array_merge($this->params, $params);
        $params['list'] = 'search';
        $params['srsearch'] = $this->_escape_string($string);
        $params['srnamespace'] = 0;

        return $this->_get_responce($this->host_api . $this->_params_to_url($params));
    }

    function get($titles, $params = array(), $options = array())
    {
        $options = array_merge($this->options, $options);
        $params = array_merge($this->params, $params);

        $params['title'] = $this->_escape_string($titles);
        $params['action'] = 'raw';

        return file_get_contents($this->host_content . $this->_params_to_url($params));
    }

    private function _params_to_url($array = array())
    {
        if( ! count($array)) return NULL;
        $string = NULL;
        foreach($array as $key => $value)
            $string .= $key . '=' . $value . '&';
        return substr($string, 0, -1);
    }

    private function _escape_string($string = NULL)
    {
        return urlencode($string);
    }

    private function _get_responce($url = NULL)
    {
        return json_decode(file_get_contents($url), TRUE);
    }
}

