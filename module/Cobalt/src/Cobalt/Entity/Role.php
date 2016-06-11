<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="access_role")
  */
class Role
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="role_id")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="roles")
     * @ORM\JoinColumn(name="role", referencedColumnName="id")
     */
    private $user;
    
    /** @ORM\Column(type="string", name="parent") */
    private $name;
    
    /** @ORM\Column(type="string", name="role_type") */
    private $type;
    
    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }


}