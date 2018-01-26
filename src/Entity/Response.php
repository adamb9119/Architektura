<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Session;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_response")
 * @ORM\Entity(repositoryClass="App\Repository\ResponseRepository")
 */
class Response
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text", length=500, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=500)
     */
    private $value;
    
    /**
     * @ORM\Column(type="text", length=500, nullable=true)
     * @Assert\Length(max=500)
     */
    private $params;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="responses")
     * @ORM\JoinColumn(nullable=true)
     */
    private $session;
    
    public function getSession(): Session
    {
        return $this->session;
    }

    public function setSession(Session $session)
    {
        $this->session = $session;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="responses")
     * @ORM\JoinColumn(nullable=true)
     */
    private $question;
    
    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question)
    {
        $this->question = $question;
    }
    
    public function setValue($value){
        if(is_array($value)){
            $this->value = json_encode($value);
            return;
        }
        $this->value = $value;
    }
    
    public function getValue(){
        if($this->isValueJSON()){
            return json_decode($this->value, true);
        }
        return $this->value;
    }
    
    function isValueJSON(){
        return is_string($this->value) && is_array(json_decode($this->value, true)) ? true : false;
    }

}
