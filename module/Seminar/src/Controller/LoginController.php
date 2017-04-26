<?php
namespace Seminar\Controller;

use Seminar\Model\Student;
use Seminar\Model\StudentDao;
use Seminar\Model\Teacher;
use Seminar\Model\TeacherDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class LoginController extends AbstractActionController {
	private $studentDao;
    private $teacherDao;

    public function __construct(StudentDao $studentDao, TeacherDao $teacherDao) {
        $this->studentDao = $studentDao;
        $this->teacherDao = $teacherDao;
    }

    public function studentAction() {
    	$nusp = $this->getRequest()->getPost('nusp');
    	$pass = $this->getRequest()->getPost('pass');

    	$token = $this->studentDao->login($nusp, $pass);
    	if ($token) {
    		return new JsonModel(array('success' => true, 'token' => $token));	
    	}
    	else {
    		return new JsonModel(array('success' => false));	
    	}
    }

    public function teacherAction() {
        $nusp = $this->getRequest()->getPost('nusp');
        $pass = $this->getRequest()->getPost('pass');

        $token = $this->teacherDao->login($nusp, $pass);
        if ($token) {
            return new JsonModel(array('success' => true, 'token' => $token));  
        }
        else {
            return new JsonModel(array('success' => false));    
        }
    }
}