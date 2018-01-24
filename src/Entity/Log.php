<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Survey;

/**
 * @ORM\Table(name="app_log")
 * @ORM\Entity(repositoryClass="App\Repository\LogRepository")
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=250, unique=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    public $title;
    
    /**
     * @ORM\Column(type="string", length=250, unique=false, nullable=true)
     * @Assert\Length(max=250)
     */
    public $params;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="logs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $survey;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $added;
    
    
    function __construct(){
        
        $this->added = new \DateTime();
    }
    
    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey)
    {
        $this->survey = $survey;
    }
    
    

}
