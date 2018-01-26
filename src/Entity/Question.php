<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Survey;
use Doctrine\Common\Collections\ArrayCollection;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * @ORM\Table(name="app_question")
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    const TYPE_TEXT = 'text';
    const TYPE_OPEN = 'open';
    const TYPE_SINGLE_CHOICE = 'single';
    const TYPE_MULTIPLE_CHOICE = 'multiple';
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    public $title;

    /**
     * @ORM\Column(type="text", length=500, nullable=true)
     * @Assert\Length(max=500)
     */
    public $description;
    
    /**
     * @ORM\Column(type="text", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     */
    public $type;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $options;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=500)
     */
    public $page;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=500)
     */
    public $number;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="questions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $survey;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="question")
     * @ORM\OrderBy({"number" = "ASC"})
     */
    private $answers;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Response", mappedBy="question")
     */
    private $responses;
    
    public function __construct() {
        $this->answers = new ArrayCollection();
        $this->responses = new ArrayCollection();
    }
    
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }
    /**
     * @return Collection|App\Entity\Answer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }
    /**
     * @return Collection|App\Entity\Answer[]
     */
    public function getAnswersArray()
    {
        $array = [];
        foreach ($this->getAnswers() as $answer){
            $array[] = $answer->toArray();
        }
        return $array;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey)
    {
        $this->survey = $survey;
    }
    
    public function toArray(){
        
        $loader = new FilesystemLoader('../templates');
        $twig = new Environment($loader, []);
        
        return [
            'id' => $this->getId(),
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'options' => $this->getOptions(),
            'page' => $this->page,
            'html' => $twig->render('survey/question/index.html.twig', ['question' => $this]),
            'number' => $this->number,
            'answers' => $this->getAnswersArray()
        ];
    }
    
    public function getOptions(){
        if($this->options){   
            return json_decode($this->options);
        }
        return [];
    }
    public function setOptions($options){
        $this->options = json_encode($options);
    }
    
    
}
