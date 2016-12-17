<?php // src/AppBundle/Entity/Account.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 */
class Account
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $accountPassword;

    /**
     * @ORM\Column(type="datetime", name="create_date")
     */
    private $createDate;

    /**
     * @ORM\Column(type="datetime", name="modifed_date")
     */
    private $modifiedDate;

    /**
     * @ORM\Column(type="integer", name="account_status", length=1)
     */
    private $accountStatus;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Account
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Account
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return Account
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set accountPassword
     *
     * @param string $accountPassword
     *
     * @return Account
     */
    public function setAccountPassword($accountPassword)
    {
        $this->accountPassword = $accountPassword;

        return $this;
    }

    /**
     * Get accountPassword
     *
     * @return string
     */
    public function getAccountPassword()
    {
        return $this->accountPassword;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Account
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set modifiedDate
     *
     * @param \DateTime $modifiedDate
     *
     * @return Account
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }

    /**
     * Get modifiedDate
     *
     * @return \DateTime
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate->format('Y-m-d H:i:s');
    }

    /**
     * Set accountStatus
     *
     * @param integer $accountStatus
     *
     * @return Account
     */
    public function setAccountStatus($accountStatus)
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    /**
     * Get accountStatus
     *
     * @return int
     */
    public function getAccountStatus()
    {
        return $this->accountStatus;
    }


}

