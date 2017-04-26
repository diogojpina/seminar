<?php
namespace Seminar\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\View\Model\JsonModel;

class TeacherDao {
	private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
    	 $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
    	return $this->tableGateway->select();
    }

    public function getTeacher($nusp) {
    	$nusp = (int) $nusp;
    	$rowset = $this->tableGateway->select(['nusp' => $nusp]);
    	$row = $rowset->current();
    	return $row;
    }

    public function login($nusp, $pass) {
    	$nusp = (int) $nusp;
    	$pass = md5($pass);
    	$rowset = $this->tableGateway->select(['nusp' => $nusp, 'pass' => $pass]);
    	$row = $rowset->current();
    	if ($row) {
    		return md5($nusp);
    	}
    	return false;
    }

    public function add(Teacher $Teacher) {
    	$data = $Teacher->toArray();
        $data['pass'] = md5($data['pass']);

    	$nusp = (int) $data['nusp'];
   		if ($this->getTeacher($nusp)) {
           	throw new RuntimeException(sprintf(
               	'O número USP %d já está cadastrado.',
                $nusp
   	        ));
        }

        $this->tableGateway->insert($data);
    }

    public function update(Teacher $Teacher) {
    	$data = $Teacher->toArray();
        $data['pass'] = md5($data['pass']);

    	$nusp = (int) $data['nusp'];
    	if (!$this->getTeacher($nusp)) {
            throw new RuntimeException(sprintf(
                'O número USP %d; não existe.',
                $nusp
            ));
        }

        $this->tableGateway->update($data, ['nusp' => $nusp]);
    }

    public function delete($nusp) {
    	$nusp = (int)$nusp;
        $this->tableGateway->delete(['nusp' => (int) $nusp]);    	
    }
}