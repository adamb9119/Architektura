<?php 

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

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
     * @ORM\Column(type="text", nullable=true)
     */
    public $entry_text;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $ending_text;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_start;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_end;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notify;
    
    /**
     * @ORM\Column(name="status", type="integer", nullable=false, options={"unsigned":true,"default":0})
     */
    public $status;

    public function __construct()
    {
        $this->status = 0;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getNotify(){
        return json_decode($this->notify);
    }
    public function setNotify($notify){
        $this->notify = json_encode($notify);
    }
    public function getDateStart(){
        if($this->date_start){
            return $this->date_start->format('Y-m-d');
        }
        return null;
    }
    public function setDateStart($date){
        $this->date_start = new DateTime($date);
    }
    public function getDateEnd(){
        if($this->date_end){
            return $this->date_end->format('Y-m-d');
        }
        return null;
    }
    public function setDateEnd($date){
        $this->date_end = new DateTime($date);
    }
}