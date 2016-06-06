<?php

namespace Notification\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="notification_field")
  */
class Field
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Template", inversedBy="fields")
     * @ORM\JoinColumn(name="notification_template_id", referencedColumnName="id")
     */
    protected $template;
    
    /** @ORM\Column(type="string", name="field_name") */
    protected $name;
    
    /** @ORM\Column(type="string", name="field_display") */
    protected $display;
    
    public function getId()
    {
        return $this->id;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDisplay()
    {
        return $this->display;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDisplay($display)
    {
        $this->display = $display;
        return $this;
    }
}