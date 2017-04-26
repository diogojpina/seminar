<?php
namespace Seminar\Controller;

use Seminar\Model\Teacher;
use Seminar\Model\TeacherDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;


class TeacherController extends AbstractActionController {
	private $TeacherDao;

    public function __construct(TeacherDao $TeacherDao) {
        $this->TeacherDao = $TeacherDao;
    }

    public function indexAction() {
    	$Teachers = $this->TeacherDao->fetchAll();

    	$data = array();
    	foreach ($Teachers as $Teacher) {
    		$data[] = $Teacher;
    	}

    	return new JsonModel(array('success' => true, 'data' => $data));
    }

    public function getAction() {
    	$nusp = $this->params()->fromRoute('nusp');

    	$json['success'] = true;

    	$json['data'] = $this->TeacherDao->getTeacher($nusp);
    	if (!$json['data']) {
    		$json['success'] = false;
    	}

    	return new JsonModel($json);	    	

    }

    public function addAction() {
    	$data['nusp'] = $this->getRequest()->getPost('nusp');
        $data['pass'] = $this->getRequest()->getPost('pass');
        $data['name'] = $this->getRequest()->getPost('name');

    	$Teacher = new Teacher($data);

    	$json = array();
    	try {
    		$this->TeacherDao->add($Teacher);
    		$json['success'] = true;
    	}
    	catch(\Exception $error) {
    		$json['success'] = true;
    		$json['message'] = $error->getMessage();
    	}

    	return new JsonModel($json);
    }

    public function editAction() {
    	$data['nusp'] = $this->getRequest()->getPost('nusp');
        $data['pass'] = $this->getRequest()->getPost('pass');
        $data['name'] = $this->getRequest()->getPost('name');
    	 
    	$Teacher = new Teacher($data);

    	$json = array();
    	try {
    		$this->TeacherDao->update($Teacher);
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
    		$this->TeacherDao->delete($nusp);
    		$json['success'] = true;
    	}
    	catch(\Exception $error) {
    		$json['success'] = true;
    		$json['message'] = $error->getMessage();
    	}

    	return new JsonModel($json);	
    }
}