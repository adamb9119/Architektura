<?php 

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Cocur\Slugify\Slugify;
use App\Entity\User;

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
    private $slug;
    
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
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="survey")
     * @ORM\OrderBy({"page" = "ASC", "number" = "ASC"})
     */
    private $questions;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="survey")
     * @ORM\OrderBy({"created" = "ASC"})
     */
    private $sessions;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Log", mappedBy="survey")
     */
    private $logs;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="surveys")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;
    
    public function __construct()
    {
        $this->status = 0;
        $this->questions = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }
    
    /**
     * @return Collection|App\Entity\Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * @return Collection|App\Entity\Question[]
     */
    public function getQuestionsArray()
    {
        $questions = $this->getQuestions();
        $array = [];
        foreach($questions as $question){
            $array[] = $question->toArray();
        }
        
        return $array;
    }
    /**
     * @return Collection|App\Entity\Question[]
     */
    public function getQuestionsInPagesArray()
    {
        $questions = $this->getQuestions();
        $array = [];
        foreach($questions as $question){
            $array[$question->page][] = $question->toArray();
        }
        
        return $array;
    }
    
    
    /**
     * @return Collection|App\Entity\Log[]
     */
    public function getLogs()
    {
        return $this->logs;
    }
    
    /**
     * @return Collection|App\Entity\Session[]
     */
    public function getSessions()
    {
        return $this->sessions;
    }
    
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
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
    
    public function setSlug($slug){
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($slug);
    }
    
    public function getSlug(){
        return $this->slug;
    }
    
    public function toArray(){
        return [
            'id' => $this->getId(),
            'title' => $this->title,
            'entry_text' => $this->entry_text,
            'ending_text' => $this->ending_text,
            'status' => $this->status,
            'date_start' => $this->getDateStart(),
            'date_end' => $this->getDateEnd(),
            'slug' => $this->getSlug(),
            'notify' => $this->getNotify(),
            'title' => $this->getSlug(),

        ];
    }
    
}