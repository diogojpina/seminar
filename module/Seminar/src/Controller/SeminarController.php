<?php
namespace Seminar\Controller;

use Seminar\Model\Seminar;
use Seminar\Model\SeminarDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class SeminarController extends AbstractActionController {
    private $seminarDao;

    public function __construct(SeminarDao $seminarDao) {
        $this->seminarDao = $seminarDao;
    }

    public function indexAction() {
        $seminars = $this->seminarDao->fetchAll();

        $data = array();
        foreach ($seminars as $seminar) {
            $data[] = $seminar;
        }

        return new JsonModel(array('success' => true, 'data' => $data));
    }

    public function getAction() {
        $id = $this->params()->fromRoute('id');

        $json['success'] = true;

        $json['data'] = $this->seminarDao->getSeminar($id);
        if (!$json['data']) {
            $json['success'] = false;
        }

        return new JsonModel($json);            

    }

    public function addAction() {
        $data['name'] = $this->getRequest()->getPost('name');
        
        $seminar = new Seminar($data);

        $json = array();
        try {
            $this->seminarDao->add($seminar);
            $json['success'] = true;
        }
        catch(\Exception $error) {
            $json['success'] = true;
            $json['message'] = $error->getMessage();
        }

        return new JsonModel($json);        
    }

    public function editAction() {
        $data['id'] = $this->getRequest()->getPost('id');
        $data['name'] = $this->getRequest()->getPost('name');
        
        $seminar = new Seminar($data);

        $json = array();
        try {
            $this->seminarDao->update($seminar);
            $json['success'] = true;
        }
        catch(\Exception $error) {
            $json['success'] = true;
            $json['message'] = $error->getMessage();
        }

        return new JsonModel($json);          
    }

    public function deleteAction() {
        $id = $this->getRequest()->getPost('id');

        $json = array();
        try {
            $this->seminarDao->delete($id);
            $json['success'] = true;
        }
        catch(\Exception $error) {
            $json['success'] = true;
            $json['message'] = $error->getMessage();
        }

        return new JsonModel($json);            
    }
}