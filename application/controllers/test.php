<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->unit->use_strict(TRUE);
        $this->unit->set_test_items(array('test_name', 'result'));

        $this->load->model('mysqli_model');
    }

    function index()
    {
        $test[]  = $this->mysqli_model->get_abbr('Czechoslovakia');
        $exp[]   = array('0' => array('abbr' => 'CSK'));
        $label[] = 'Get abbr from countries';

        $test[]  = $this->mysqli_model->get_abbr('West Germany');
        $exp[]   = 'FRG';
        $label[] = 'Get abbr from countries (2)';

        $test[]  = 1 + 1;
        $exp[]   = 2;
        $label[] = 'Get abbr from countries';

        $this->_test($test, $exp, $label);
    }

    private function _test($test, $exp, $label)
    {
        $num_tests = count($test);
        for ($i = 0; $i < $num_tests; $i++) 
        {
            $this->unit->run($test[$i], $exp[$i], $label[$i]);
            $result = $this->unit->result();
        }
    }

    private function _report()
    {
        echo $this->unit->report();
        #print_r($this->unit->result());
    }

    function __destruct()
    {
        $this->_report();
    }
}
