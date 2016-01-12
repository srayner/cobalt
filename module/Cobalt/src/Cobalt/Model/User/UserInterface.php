<?php

namespace Cobalt\Model\User;

interface UserInterface
{
    public function getUserId();
    public function setUserId($userId);
    
    public function getUsername();
    public function setUsername($username);
    
    public function getEmail();
    public function setEmail($email);
    
    public function getSamAccountName();
    public function setSamAccountName($samAccountName);
    
    public function getUserPrincipalName();
    public function setUserPrincipalName($userPrincipalName);
    
    public function getTelephoneNumber();
    public function setTelephoneNumber($telephoneNumber);
    
    public function getExtensionNumber();
    public function setExtensionNumber($extensionNumber);
    
    public function getDisplayName();
    public function setDisplayName($displayName);
    
    public function getDescription();
    public function setDescription($description);
    
    public function getOffice();
    public function setOffice($office);
    
    public function getPhotoFilename();
    public function setPhotoFilename($filename);
}