<?php
/**
 * Created by PhpStorm.
 * User: obber
 * Date: 3/20/2017
 * Time: 19:08
 */

namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class User {
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected $username;

    /** @ORM\Column(type="string", nullable=false) */
    protected $password;

    /**
     * @var Deck[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Deck",mappedBy="user")
     */
    protected $decks;

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
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getJsonData()
    {
        $decks = [];
        //var_dump($decks);
        foreach($this->decks as $deck)
        {
            $decks[] = $deck->getJsonData();
        }

        return [
            //'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'decks' => $decks
        ];
    }
}