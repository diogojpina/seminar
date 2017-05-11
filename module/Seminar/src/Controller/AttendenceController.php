<?php
namespace Seminar\Controller;

use Seminar\Model\Attendence;
use Seminar\Model\AttendenceDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;


class AttendenceController extends AbstractActionController {
	private $attendenceDao;

    public function __construct(AttendenceDao $attendenceDao) {
        $this->attendenceDao = $attendenceDao;
    }

    public function getAction() {
        $data['student_nusp'] = $this->getRequest()->getPost('nusp');
        $data['seminar_id'] = $this->getRequest()->getPost('seminar_id');

        $attendence = new Attendence($data);

        $json['success'] = true;

        $json['data'] = $this->attendenceDao->getAttendence($attendence);

        if (!$json['data']) {
            $json['success'] = false;
        }

        return new JsonModel($json);            
    }

    public function listStudentsAction() {
        $seminar_id =  $this->getRequest()->getPost('seminar_id');        

        $students = $this->attendenceDao->listStudents($seminar_id);

        $json = array('success' => true);
        foreach ($students as $student) {
            $json['data'][] = $student;
        }

        return new JsonModel($json);
    }

    public function listSeminarsAction() {
        $student_nusp =  $this->getRequest()->getPost('nusp');        

        $seminars = $this->attendenceDao->listSeminars($student_nusp);

        $json = array('success' => true);
        foreach ($seminars as $seminar) {
            $json['data'][] = $seminar;
        }

        return new JsonModel($json);
    }    

    public function submitAction() {
    	$data['student_nusp'] = $this->getRequest()->getPost('nusp');
    	$data['seminar_id'] = $this->getRequest()->getPost('seminar_id');
        $data['data'] = ($this->getRequest()->getPost('data')===null)?null:$this->getRequest()->getPost('data');
        $data['confirmed'] = ($this->getRequest()->getPost('confirmed')===null)?null:(int)$this->getRequest()->getPost('confirmed');        

    	$attendence = new Attendence($data);

    	$this->attendenceDao->submit($attendence);

    	return new JsonModel(array('success' => true));
    }
}
