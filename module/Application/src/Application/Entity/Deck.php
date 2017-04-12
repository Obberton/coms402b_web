<?php
/**
 * Created by PhpStorm.
 * User: obber
 * Date: 3/24/2017
 * Time: 13:45
 */

namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Deck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @var Card[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Card",inversedBy="decks")
     */
    protected $cards;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Card[]|ArrayCollection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param Card[]|ArrayCollection $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    public function getJsonData()
    {
        $cards = [];
        foreach($this->cards as $card)
        {
            $cards[] = $card->getJsonData();
        }

        return [
            "cards" => $cards
        ];
    }
}