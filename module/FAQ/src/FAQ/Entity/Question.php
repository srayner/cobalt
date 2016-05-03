<?php

namespace FAQ\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="faq_question")
  */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $question;
    
    /** @ORM\Column(type="text") */
    protected $answer;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getQuestion()
    {
        return $this->question;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }
}
