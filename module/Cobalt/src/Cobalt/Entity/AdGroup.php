<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="ad_group")
  */
class AdGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id")
     */
    protected $id;
    
    /** @ORM\Column(type="string" name="diaply_name") */
    protected $displayName;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="string") */
    protected $scope;
    
    /** @ORM\Column(type="string", name="group_name") */
    protected $groupType;
    
    public function getId() {
        return $this->id;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getScope() {
        return $this->scope;
    }

    public function getGroupType() {
        return $this->groupType;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setScope($scope) {
        $this->scope = $scope;
        return $this;
    }

    public function setGroupType($groupType) {
        $this->groupType = $groupType;
        return $this;
    }
}