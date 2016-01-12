<?php

namespace Cobalt\Model\User;

class User implements UserInterface
{
    protected $userId;
    protected $username;
    protected $email;
    protected $samAccountName;
    protected $userPrincipalName;
    protected $telephoneNumber;
    protected $extensionNumber;
    protected $displayName;
    protected $description;
    protected $office;
    protected $photoFilename;


    public function getUserId()
    {
        return $this->userId;
    }
    
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    public function getSamAccountName()
    {
        return $this->samAccountName;
    }
    
    public function setSamAccountName($samAccountName)
    {
        $this->samAccountName = $samAccountName;
        return $this;
    }
    
    public function getUserPrincipalName()
    {
        return $this->userPrincipalName;
    }
    
    public function setUserPrincipalName($userPrincipalName)
    {
        $this->userPrincipalName = $userPrincipalName;
        return $this;
    }
    
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }
    
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;
        return $this;
    }
    
    public function getExtensionNumber()
    {
        return $this->extensionNumber;
    }
    
    public function setExtensionNumber($extensionNumber)
    {
        $this->extensionNumber = $extensionNumber;
        return $this;
    }
    
    public function getDisplayName()
    {
        return $this->displayName;
    }
    
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    public function getOffice()
    {
        return $this->office;
    }
    
    public function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }
    
    public function getPhotoFilename()
    {
        return $this->photoFilename;
    }
    
    public function setPhotoFilename($filename)
    {
        $this->photoFilename = $filename;
        return $this;
    }
}