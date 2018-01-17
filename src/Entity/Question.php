<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Survey;

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

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey)
    {
        $this->survey = $survey;
    }
    
    
}
