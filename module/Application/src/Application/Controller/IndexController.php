<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entity;

    public function indexAction()
    {
        $objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');

        $user = new \Application\Entity\User();
        $user->setUsername('obberton');
        $user->setPassword('password');

        $allObjects = $objectManager->getRepository('Application\Entity\User')->findAll();
        $jsonArray = array_map(function($obj){
            /* @var $obj \Application\Entity\User */
            return $obj->getJsonData();
        }, $allObjects);
        return new JsonModel($jsonArray);
    }

    public function addAction()
    {
        $this->entity = $this->serviceLocator->get('Doctrine\ORM\EntityManager');

        $user = new User();
        $user->setUsername($_REQUEST['username']);
        $user->setPassword($_REQUEST['password']);

        $this->entity->persist($user);
        $this->entity->flush();

        return new JsonModel($_REQUEST);
    }

    public function removeAllUsersAction()
    {
        $objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');

        $allObjects = $objectManager->getRepository('Application\Entity\User')->findAll();
        foreach($allObjects as $object)
        {
            $objectManager->remove($object);
        }
        $objectManager->flush();
        return new JsonModel();
    }
}
