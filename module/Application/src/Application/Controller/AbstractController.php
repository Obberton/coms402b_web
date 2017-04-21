<?php
/**
 * Created by PhpStorm.
 * User: obber
 * Date: 4/12/2017
 * Time: 18:33
 */

namespace Application\Controller;


use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;

class AbstractController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    private $_entity;

    /**
     * @return EntityManager
     */
    protected function entity()
    {
        if($this->_entity == null)
        {
            $this->_entity = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        }
        return $this->_entity;
    }

    /**
     * @var User
     */
    private $_user;

    /**
     * @return User
     */
    protected function user()
    {
        if($this->_user) return $this->_user;
        $sessionId = array_key_exists('sessionid', $_REQUEST)?$_REQUEST['sessionid']:null;
        $user = $this->entity()->getRepository('Application\Entity\User')->findOneBy(['sessionId'=>$sessionId]);
        if(!$user)
        {
            http_response_code(403);
            die;
        }
        /* @var $user User */
        $this->_user = $user;
        return $user;
    }

    protected function request($string)
    {
        return array_key_exists($string, $_REQUEST)?$_REQUEST[$string]:null;
    }
}