<?php
namespace Seminar;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface {
    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

	public function getServiceConfig() {
        return [
            'factories' => [
                Model\StudentDao::class => function($container) {
                    $tableGateway = $container->get(Model\StudentTableGateway::class);
                    return new Model\StudentDao($tableGateway);
                },
                Model\StudentTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Student());
                    return new TableGateway('student', $dbAdapter, null, $resultSetPrototype);
                },
                Model\TeacherDao::class => function($container) {
                    $tableGateway = $container->get(Model\TeacherTableGateway::class);
                    return new Model\TeacherDao($tableGateway);
                },
                Model\TeacherTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Teacher());
                    return new TableGateway('teacher', $dbAdapter, null, $resultSetPrototype);
                },
                Model\SeminarDao::class => function($container) {
                    $tableGateway = $container->get(Model\SeminarTableGateway::class);
                    return new Model\SeminarDao($tableGateway);
                },
                Model\SeminarTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Seminar());
                    return new TableGateway('seminar', $dbAdapter, null, $resultSetPrototype);
                },
                Model\AttendenceDao::class => function($container) {
                    $tableGateway = $container->get(Model\AttendenceTableGateway::class);
                    return new Model\AttendenceDao($tableGateway);
                },
                Model\AttendenceTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Attendence());
                    return new TableGateway('attendence', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }    

    public function getControllerConfig() {
        return [
            'factories' => [
                Controller\StudentController::class => function($container) {
                    return new Controller\StudentController(
                        $container->get(Model\StudentDao::class)
                    );
                },
                Controller\TeacherController::class => function($container) {
                    return new Controller\TeacherController(
                        $container->get(Model\TeacherDao::class)
                    );
                },
                Controller\SeminarController::class => function($container) {
                    return new Controller\SeminarController(
                        $container->get(Model\SeminarDao::class)
                    );
                },
                Controller\AttendenceController::class => function($container) {
                    return new Controller\AttendenceController(
                        $container->get(Model\AttendenceDao::class)
                    );
                },
                Controller\LoginController::class => function($container) {
                    return new Controller\LoginController(
                        $container->get(Model\StudentDao::class),
                        $container->get(Model\TeacherDao::class)
                    );
                },
            ],
        ];
    }    
}