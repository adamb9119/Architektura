<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Survey;

/**
 * @ORM\Table(name="app_session")
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $ip;
    
    /**
     * @ORM\Column(type="text", length=500, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=500)
     */
    private $client;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $created;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Response", mappedBy="session")
     */
    private $responses;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="sessions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $survey;
    

    public function __construct() {
        $this->created = new DateTime('now');
        $this->client = $_SERVER['HTTP_USER_AGENT'];
        $this->responses = new ArrayCollection();
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setIp($ip){
        $this->ip = $ip;
    }
    public function getIp(){
        return $this->ip;
    }
    public function getClient(){
        return $this->client;
    }
    public function getCreated(){
        return $this->created;
    }
    
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }
    /**
     * @return Collection|App\Entity\Response[]
     */
    public function getResponses()
    {
        return $this->responses;
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
