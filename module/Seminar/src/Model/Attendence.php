<?php
namespace Seminar\Model;

class Attendence {
    public $student_nusp;
    public $seminar_id;
    public $data;
    public $confirmed;
    public $dateTime;

    public function __construct($data=null) {
    	if ($data) {
    		$this->exchangeArray($data);
    	}
    }

    public function exchangeArray(array $data) {
        $this->student_nusp	= !empty($data['student_nusp']) ? $data['student_nusp'] : null;
        $this->seminar_id	= !empty($data['seminar_id']) ? $data['seminar_id'] : null;
        $this->data   = ($data['data'] != null) ? $data['data'] : null;
        $this->confirmed   = ($data['confirmed'] != null) ? $data['confirmed'] : null;
        $this->dateTime   = !empty($data['dateTime']) ? $data['dateTime'] : null;
    }

    public function toArray() {
    	$data = array();
    	$data['student_nusp'] = $this->student_nusp;
    	$data['seminar_id'] = $this->seminar_id;
        $data['confirmed'] = $this->confirmed;
        $data['data'] = $this->data;
    	$data['dateTime'] = $this->dateTime;
    	return $data;
    }
}