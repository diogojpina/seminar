<?php
namespace Seminar\Controller;

use Seminar\Model\Student;
use Seminar\Model\StudentDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;


class StudentController extends AbstractActionController {
	private $studentDao;

    public function __construct(StudentDao $studentDao) {
        $this->studentDao = $studentDao;
    }

    public function indexAction() {
    	$students = $this->studentDao->fetchAll();

    	$data = array();
    	foreach ($students as $student) {
    		$data[] = $student;
    	}

    	return new JsonModel(array('success' => true, 'data' => $data));
    }

    public function getAction() {
    	$nusp = $this->params()->fromRoute('nusp');

    	$json['success'] = true;

    	$json['data'] = $this->studentDao->getStudent($nusp);
    	if (!$json['data']) {
    		$json['success'] = false;
    	}

    	return new JsonModel($json);	    	

    }

    public function addAction() {
    	$data['nusp'] = $this->getRequest()->getPost('nusp');
    	$data['pass'] = $this->getRequest()->getPost('pass');
    	$data['name'] = $this->getRequest()->getPost('name');

    	$student = new Student($data);

    	$json = array();
    	try {
    		$this->studentDao->add($student);
    		$json['success'] = true;
    	}
    	catch(\Exception $error) {
    		$json['success'] = false;
    		$json['message'] = $error->getMessage();
    	}

    	return new JsonModel($json);
    }

    public function editAction() {
    	$data['nusp'] = $this->getRequest()->getPost('nusp');
        $data['pass'] = $this->getRequest()->getPost('pass');
        $data['name'] = $this->getRequest()->getPost('name');
    	 
    	$student = new Student($data);

    	$json = array();
    	try {
    		$this->studentDao->update($student);
    		$json['success'] = true;
    	}
    	catch(\Exception $error) {
    		$json['success'] = true;
    		$json['message'] = $error->getMessage();
    	}

    	return new JsonModel($json);    	
    }

    public function deleteAction() {
    	$nusp = $this->getRequest()->getPost('nusp');

    	$json = array();
    	try {
    		$this->studentDao->delete($nusp);
    		$json['success'] = true;
    	}
    	catch(\Exception $error) {
    		$json['success'] = true;
    		$json['message'] = $error->getMessage();
    	}

    	return new JsonModel($json);	
    }
}