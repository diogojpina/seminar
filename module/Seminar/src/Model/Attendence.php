<?php
namespace Seminar\Model;

class Attendence {
    public $student_nusp;
    public $seminar_id;
    public $dateTime;

    public function __construct($data=null) {
    	if ($data) {
    		$this->exchangeArray($data);
    	}
    }

    public function exchangeArray(array $data) {
        $this->student_nusp	= !empty($data['student_nusp']) ? $data['student_nusp'] : null;
        $this->seminar_id	= !empty($data['seminar_id']) ? $data['seminar_id'] : null;
    }

    public function toArray() {
    	$data = array();
    	$data['student_nusp'] = $this->student_nusp;
    	$data['seminar_id'] = $this->seminar_id;
    	$data['dateTime'] = $dateTime;
    	return $data;
    }
}