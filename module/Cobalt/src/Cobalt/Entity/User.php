<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
  * @ORM\Table(name="user")
  */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="user_id")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $username;
    
    /** @ORM\Column(type="string") */
    protected $email;
    
    /** @ORM\Column(type="string", name="sam_account_name") */
    protected $samAccountName;
    
    /** @ORM\Column(type="string", name="user_principal_name") */
    protected $userPrincipalName;
    
    /** @ORM\Column(type="string", name="telephone_number") */
    protected $telephoneNumber;
    
    /** @ORM\Column(type="string", name="extension_number") */
    protected $extensionNumber;
    
    /** @ORM\Column(type="string", name="display_name") */
    protected $displayName;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="string") */
    protected $office;
    
    /** @ORM\Column(type="string", name="photo_filename") */
    protected $photoFilename;
    
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSamAccountName()
    {
        return $this->samAccountName;
    }

    public function getUserPrincipalName()
    {
        return $this->userPrincipalName;
    }

    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    public function getExtensionNumber()
    {
        return $this->extensionNumber;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getOffice()
    {
        return $this->office;
    }

    public function getPhotoFilename()
    {
        return $this->photoFilename;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setSamAccountName($samAccountName)
    {
        $this->samAccountName = $samAccountName;
        return $this;
    }

    public function setUserPrincipalName($userPrincipalName)
    {
        $this->userPrincipalName = $userPrincipalName;
        return $this;
    }

    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;
        return $this;
    }

    public function setExtensionNumber($extensionNumber)
    {
        $this->extensionNumber = $extensionNumber;
        return $this;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

    public function setPhotoFilename($photoFilename)
    {
        $this->photoFilename = $photoFilename;
        return $this;
    }


    
}