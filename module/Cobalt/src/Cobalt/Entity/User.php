<?php

namespace Cobalt\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity
  * @ORM\Table(name="user")
  */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $username;
    
    /** @ORM\Column(type="string") */
    protected $password;
    
    /** @ORM\Column(type="string") */
    protected $domain;
    
    /** @ORM\Column(type="string", name="email_address") */
    protected $emailAddress;
    
    /** @ORM\Column(type="string", name="sam_account_name") */
    protected $samAccountName;
    
    /** @ORM\Column(type="string", name="user_principal_name") */
    protected $userPrincipalName;
    
    /** @ORM\Column(type="string", name="telephone_number") */
    protected $telephoneNumber;
    
    /** @ORM\Column(type="string", name="extension_number") */
    protected $extensionNumber;
    
    /** @ORM\Column(type="string", name="mobile_number") */
    protected $mobileNumber;
    
    /** @ORM\Column(type="string", name="display_name") */
    protected $displayName;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Office", cascade={"persist"})
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id")
     */
    protected $office;
    
    /**
     * @ORM\ManyToOne(targetEntity="Company", cascade={"persist"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;
    
    /** @ORM\Column(type="string") */
    protected $department;
    
    /** @ORM\Column(type="string") */
    protected $title;
    
    /** @ORM\Column(type="datetime", name="bad_password_time") */
    protected $badPasswordTime;
    
    /** @ORM\Column(type="integer", name="bad_password_count") */
    protected $badPasswordCount;
    
    /** @ORM\Column(type="string", name="photo_filename") */
    protected $photoFilename;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="reports_to_id", referencedColumnName="id")
     */
    protected $reportsTo;
    
    /**
     * @ORM\ManyToMany(targetEntity="Computer", inversedBy="users")
     * @ORM\JoinTable(name="user_computer",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="computer_id", referencedColumnName="computer_id")}
     * )
     */
    protected $computers;
    
    /**
     * @ORM\OneToMany(targetEntity="Role", mappedBy="user", cascade={"persist"})
     */
    protected $roles;
    
    public function __construct()
    {
        $this->computers = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }
    
    public function addComputer($computer)
    {
        $computer->addUser($this);
        $this->computers[] = $computer;
    }
    
    public function addRole($role)
    {
        $role->setUser($this);
        $this->roles[] = $role;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
            return $this->password;
    }
    
    public function getDomain()
    {
        return $this->domain;
    }
    
    public function getEmailAddress()
    {
        return $this->emailAddress;
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

    public function getMobileNumber()
    {
        return $this->mobileNumber;
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

    public function getCompany()
    {
        return $this->company;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function getBadPasswordTime()
    {
        return $this->badPasswordTime;
    }

    public function getBadPasswordCount()
    {
        return $this->badPasswordCount;
    }

    public function getPhotoFilename()
    {
        return $this->photoFilename;
    }

    public function getReportsTo()
    {
        return $this->reportsTo;
    }

    public function getComputers()
    {
        return $this->computers;
    }
    
    public function getRoles()
    {
        return $this->roles->toArray();
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

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }
    
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
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

    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
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

    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setBadPasswordTime($badPasswordTime)
    {
        $this->badPasswordTime = $badPasswordTime;
        return $this;
    }

    public function setBadPasswordCount($badPasswordCount)
    {
        $this->badPasswordCount = $badPasswordCount;
        return $this;
    }
    
    public function setPhotoFilename($photoFilename)
    {
        $this->photoFilename = $photoFilename;
        return $this;
    }
    
    public function setReportsTo($user)
    {
        $this->reportsTo = $user;
        return $this;
    }
}
