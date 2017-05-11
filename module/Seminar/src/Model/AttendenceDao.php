<?php

namespace Seminar\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\View\Model\JsonModel;

class AttendenceDao {
	private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
    	 $this->tableGateway = $tableGateway;
    }

    public function listStudents($seminar_id) {
        $seminar_id = (int) $seminar_id;
        return $this->tableGateway->select(['seminar_id' => $seminar_id]);
    }

    public function listSeminars($student_nusp) {
        $student_nusp = (int) $student_nusp;
        return $this->tableGateway->select(['student_nusp' => $student_nusp]);
    }

    public function getAttendence(Attendence $attendence) {
    	$student_nusp = (int)$attendence->student_nusp;
    	$seminar_id = (int)$attendence->seminar_id;
    	$rowset = $this->tableGateway->select(['student_nusp' => $student_nusp, 'seminar_id' => $seminar_id]);
    	$row = $rowset->current();
    	return $row;
    }

    public function submit(Attendence $attendence) {
        $row = $this->getAttendence($attendence);        
        
    	if (!$row) {
    		date_default_timezone_set('America/America/Sao_Paulo');
    		$data = $attendence->toArray();

            if ($data['confirmed'] == null) {
                $data['confirmed'] = 1;
            }

    		$data['dateTime'] = date('Y-m-d H:i:s');
    		$this->tableGateway->insert($data);
    	}
        else {
            $data = $attendence->toArray();            
            if ($data['data'] == null) {
                $data['data'] = $row->data;
            }

            if ($data['confirmed'] == null) {
                $data['confirmed'] = $row->confirmed;
            }
            $data['dateTime'] = $row->dateTime;

            $this->tableGateway->update($data, ['student_nusp' => $data['student_nusp'], 'seminar_id' => $data['seminar_id']]);
            
        }
    }
}
?>