<?php
/**
 * Created by PhpStorm.
 * User: obber
 * Date: 4/11/2017
 * Time: 23:18
 */

namespace Application\Controller;


use Application\Entity\Deck;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class DeckController extends AbstractActionController
{
    public function addAction()
    {
        return new JsonModel();
    }

    public function addDeckAction()
    {
        $objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        $deck = new Deck();
        $user = $objectManager->getRepository("Application\\Entity\\User")->findOneBy(['username' => $_REQUEST['username']]);
        $deck->setUser($user);
        $objectManager->persist($deck);
        $objectManager->flush();
        return new JsonModel();
    }
}