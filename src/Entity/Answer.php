<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Question;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_answer")
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
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
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    public $number;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers")
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
    
    public function getId(){
        return $this->id;
    }
    
    public function toArray(){
        return [
            'id' => $this->getId(),
            'title' => $this->title,
            'number' => $this->number,
        ];
    }
}
