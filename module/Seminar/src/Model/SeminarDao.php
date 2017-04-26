<?php
namespace Seminar\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class SeminarDao {
	private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
    	 $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
    	return $this->tableGateway->select();
    }

    public function getSeminar($id) {
    	$id = (int) $id;
    	$rowset = $this->tableGateway->select(['id' => $id]);
    	$row = $rowset->current();
    	return $row;
    }    

    public function add(Seminar $seminar) {
    	$data = $seminar->toArray();

        $this->tableGateway->insert($data);
    }

    public function update(Seminar $seminar) {
        $data = $seminar->toArray();

        $id = (int) $data['id'];
        if (!$this->getSeminar($id)) {
            throw new RuntimeException(sprintf(
                'O seminário de ID %d; não existe.',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);        
    }

    public function delete($id) {
        $id = (int) $id;
        $this->tableGateway->delete(['id' => $id]);       
    }

 }