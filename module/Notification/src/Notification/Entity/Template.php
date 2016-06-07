<?php

namespace Notification\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="notification_template")
  */
class Template
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="boolean") */
    protected $active;
    
    /** @ORM\Column(type="string") */
    protected $name;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="string", name="mime_type") */
    protected $mimeType;
    
    /** @ORM\Column(type="text", name="subject") */
    protected $subject;
    
    /** @ORM\Column(type="text", name="content") */
    protected $template;
    
    /**
     * @ORM\OneToMany(targetEntity="Field", mappedBy="template")
     */
    protected $fields;
    
    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }
    
    public function addField($field)
    {
        $this->fields[] = $field;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getActive()
    {
        return $this->active;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getFields()
    {
        return $this->fields->toArray();
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
}

