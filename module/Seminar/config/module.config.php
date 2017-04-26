<?php
namespace Seminar;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;


return [
    'controllers' => [
        'factories' => [


        ],
    ],

   'router' => [
        'routes' => [
            'student' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/student[/:action[/:nusp]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'nusp'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\StudentController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'teacher' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/teacher[/:action[/:nusp]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'nusp'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\TeacherController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'seminar' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/seminar[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\SeminarController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'attendence' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/attendence[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AttendenceController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'login' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/login[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'index',
                    ],
                ],
            ],            
        ],
    ],    

    'view_manager' => [
        'template_path_stack' => [
            'seminar' => __DIR__ . '/../view',
        ],
        'strategies'                => array(
            'ViewJsonStrategy',
        ),
    ],

];