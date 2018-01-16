<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_usermeta")
 * @ORM\Entity(repositoryClass="App\Repository\UsermetaRepository")
 */
class Usermeta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $value;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="usermeta")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
    
    public function setName($name){
        $this->name = $name;
    }
}
