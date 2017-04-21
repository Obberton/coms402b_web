<?php
/**
 * Created by PhpStorm.
 * User: obber
 * Date: 4/11/2017
 * Time: 23:18
 */

namespace Application\Controller;


use Application\Entity\Deck;
use Zend\View\Model\JsonModel;

class DeckController extends AbstractController
{
    public function addAction()
    {
        return new JsonModel();
    }

    public function addDeckAction()
    {
        $deck = new Deck();
        $user = $this->user();
        /* @var $user \Application\Entity\User */
        $deck->setUser($user);
        $this->entity()->persist($deck);
        $this->entity()->flush();
        return new JsonModel();
    }

    public function removeDeckAction()
    {
        $user = $this->user();

    }

    public function addCardAction()
    {
        $user = $this->user();
        $deckId = $this->request("deckid");
        $deck = $this->entity()->getRepository("Application\\Entity\\Deck")->findOneBy(['id'=>$deckId]);
        $cardname = $this->request("sessionid");
        $card = $this->entity()->getRepository("Application\\Entity\\Card")->findOneBy(['name'=>$cardname]);
        if(!$card||!$deck)
        {
            http_response_code(404);
            die;
        }
        /* @var $deck Deck */
        /* @var $card \Application\Entity\Card */
        $deck->getCards()->add($card);
        $this->entity()->flush();
        return new JsonModel();
    }

    public function removeCardAction()
    {
        $user = $this->user();
        $deckId = $this->request("deckid");
        $deck = $this->entity()->getRepository("Application\\Entity\\Deck")->findOneBy(['id'=>$deckId]);
        $cardname = $this->request("sessionid");
        $card = $this->entity()->getRepository("Application\\Entity\\Card")->findOneBy(['name'=>$cardname]);
        if(!$card||!$deck)
        {
            http_response_code(404);
            die;
        }
        /* @var $deck Deck */
        /* @var $card \Application\Entity\Card */
        $deck->getCards()->removeElement($card);
        $this->entity()->flush();
        return new JsonModel();
    }
}