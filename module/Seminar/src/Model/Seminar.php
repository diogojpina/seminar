<?php
namespace Seminar\Model;

class Seminar {
    public $id;
    public $name;

    public function __construct($data=null) {
    	if ($data) {
    		$this->exchangeArray($data);
    	}
    }

    public function exchangeArray(array $data) {
        $this->id     	= !empty($data['id']) ? $data['id'] : null;
        $this->name 	= !empty($data['name']) ? $data['name'] : null;
    }

    public function toArray() {
    	$data = array();
    	$data['id'] = $this->id;
    	$data['name'] = $this->name;
    	return $data;
    }
}