<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wikiread
{
    private $host;
    private $options = array();
    private $params = array();

    function __construct()
    {
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
        #action=query&list=search&srsearch=wikipedia&srprop=timestamp
        $params = array_merge($this->params, $params);
        $params['list'] = 'search';
        $params['srsearch'] = $this->_escape_string($string);

        $responce = json_decode(file_get_contents($this->host . $this->_params_to_url($params)));
        print_r($responce->query->search);
    }

    function get($titles, $options = array())
    {
        $this->options = array_merge($this->options, $options);

        $params = $this->params;
        $params['titles'] = $this->_escape_string($titles);

        $url = $this->host . $this->_params_to_url($params);
        echo $url;

        #$http = new HttpRequest($url);
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
}

