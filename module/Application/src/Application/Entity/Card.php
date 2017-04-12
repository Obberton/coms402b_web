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
class Card
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    protected $id;

    /**
     * @var Deck[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Deck", mappedBy="cards")
     */
    protected $decks;

    /**
     * @var string
     * @ORM\Column
     */
    protected $name;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Deck[]|ArrayCollection
     */
    public function getDecks()
    {
        return $this->decks;
    }

    /**
     * @param Deck[]|ArrayCollection $decks
     */
    public function setDecks($decks)
    {
        $this->decks = $decks;
    }
}