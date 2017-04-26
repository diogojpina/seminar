<?php
namespace Seminar\Model;

class Teacher {
    public $nusp;
    public $name;
    public $pass;

    public function __construct($data=null) {
    	if ($data) {
    		$this->exchangeArray($data);
    	}
    }

    public function exchangeArray(array $data) {
        $this->nusp     = !empty($data['nusp']) ? $data['nusp'] : null;
        $this->pass 	= !empty($data['pass']) ? $data['pass'] : null;
        $this->name 	= !empty($data['name']) ? $data['name'] : null;
    }

    public function toArray() {
    	$data = array();
    	$data['nusp'] = $this->nusp;
    	$data['pass'] = $this->pass;
    	$data['name'] = $this->name;
    	return $data;
    }
}