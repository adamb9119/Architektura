<?php 

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_survey")
 * @ORM\Entity(repositoryClass="App\Repository\SurveyRepository")
 */
class Survey
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    public $title;
    
    /**
     * @ORM\Column(type="string", length=250, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    public $slug;
    
    /**
     * @ORM\Column(name="status", type="integer", nullable=false, options={"unsigned":true,"default":0})
     */
    public $status;

    public function __construct()
    {
        $this->status = 0;
    }
    
}