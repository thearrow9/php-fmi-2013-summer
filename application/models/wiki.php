<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wiki extends CI_Model
{
    private $host;
    private $options = array();
    private $params = array();

    function __construct()
    {
        parent::__construct();
        $this->host = 'http://wikipedia.org/w/api.php?';
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

        return $this->_get_responce($this->host . $this->_params_to_url($params));
    }

    function get($titles, $options = array())
    {
        $this->options = array_merge($this->options, $options);
        echo $titles;
        $params = $this->params;
        $params['titles'] = $this->_escape_string($titles);
        $params['prop'] = 'revisions';
        $params['rvprop'] = 'content';

        return $this->_get_responce($this->host . $this->_params_to_url($params));
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

