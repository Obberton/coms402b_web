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
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $user = new \Application\Entity\User();
        $user->setUsername('obberton');
        $user->setPassword('password');

        $allObjects = $this->entity()->getRepository('Application\Entity\User')->findAll();
        $jsonArray = array_map(function($obj){
            /* @var $obj \Application\Entity\User */
            return $obj->getJsonData();
        }, $allObjects);
        return new JsonModel($jsonArray);
    }

    public function addAction()
    {
        $user = new User();
        $user->setUsername($_REQUEST['username']);
        $user->setPassword($_REQUEST['password']);

        $this->entity()->persist($user);
        $this->entity()->flush();

        return new JsonModel($_REQUEST);
    }

    public function loginAction()
    {
        $username = $this->request('username');
        $password = $this->request('password');
        /* @var $user User */
        $user = $this->entity()->getRepository('Application\Entity\User')->findOneBy(['username'=>$username, 'password'=>$password]);
        if(!$user) {
            http_response_code(401);
            die;
        }
        $user->setSessionId($user->getUsername().time());
        $this->entity()->flush();
        return new JsonModel([
            'sessionId' => $user->getSessionId()
        ]);
    }

    public function getUserDecksAction()
    {
        $user = $this->entity()->getRepository('Application\Entity\User')->findOneBy(['username'=>$this->request('username')]);
        if(!$user) {
            http_response_code(404);
            die;
        }
        return new JsonModel($user->getJsonData());
    }

    public function removeAllUsersAction()
    {
        $allObjects = $this->entity()->getRepository('Application\Entity\User')->findAll();
        foreach($allObjects as $object)
        {
            $this->entity()->remove($object);
        }
        $this->entity()->flush();
        return new JsonModel();
    }
}
