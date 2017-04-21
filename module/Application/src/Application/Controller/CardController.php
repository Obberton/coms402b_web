<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Card;
use Application\Entity\Deck;
use Application\Entity\User;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class CardController extends AbstractController
{
    public function importCSVAction()
    {
        $allObjects = $this->entity()->getRepository('Application\Entity\Card')->findAll();
        foreach($allObjects as $object) {
            $this->entity()->remove($object);
        }

        $monsterfile = new \SplFileObject("public/Monsters.csv");
        $spellfile = new \SplFileObject("public/Spells.csv");
        $terrainfile = new \SplFileObject("public/Terrain.csv");

        $monsterfile->setFlags(\SplFileObject::READ_CSV);
        $spellfile->setFlags(\SplFileObject::READ_CSV);
        $terrainfile->setFlags(\SplFileObject::READ_CSV);

        foreach($monsterfile as $row) {
            if($row[0] != 'Name') {
                $card = new Card();
                $card->setName($row[0]);
                $this->entity()->persist($card);
            }
        }
        foreach($spellfile as $row) {
            if($row[0] != 'Name') {
                $card = new Card();
                $card->setName($row[0]);
                $this->entity()->persist($card);
            }
        }
        foreach($terrainfile as $row) {
            if($row[0] != 'Name') {
                $card = new Card();
                $card->setName($row[0]);
                $this->entity()->persist($card);
            }
        }
        $this->entity()->flush();
        return new JsonModel();
    }

    public function getAllCardsAction()
    {
        $allObjects = $this->entity()->getRepository('Application\Entity\Card')->findAll();
        $cardArray = array_map(function($obj){
            return $obj->getName();
        }, $allObjects);

        return new JsonModel($cardArray);
    }
}