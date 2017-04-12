<?php
/**
 * Created by PhpStorm.
 * User: obber
 * Date: 3/22/2017
 * Time: 17:47
 */
return [
    'routes' => array(
        'home' => array(
            'type' => 'Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    '__NAMESPACE__' => 'Application\Controller',
                    'controller' => 'Index',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'default' => array(
                    'type' => 'Segment',
                    'options' => array(
                        'route' => '[:controller[/:action]]',
                        'constraints' => array(
                            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                        'defaults' => array(),
                    ),
                ),
            ),
        ),
    ),
];
