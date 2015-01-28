<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * User
 *
 * @ORM\Table(name="visiativ_user", uniqueConstraints={
 *   @ORM\UniqueConstraint(
 *     name="user_username_unique",
 *     columns={ "username" }
 *   ),
 *   @ORM\UniqueConstraint(
 *     name="user_email_address_unique",
 *     columns={ "email_address" }
 *   )
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 *
 * @UniqueEntity("username", message="user.username.not_unique", groups={"Signup"})
 * @UniqueEntity("emailAddress", message="user.email_address.not_unique")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(length=30)
     *
     * @Assert\NotBlank(groups="Signup")
     * @Assert\Length(min=5, max=30, groups="Signup")
     * @Assert\Regex("/^[a-z0-9]+$/i", groups="Signup", message="user.username.invalid_format")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $emailAddress;

    /**
     * @var string
     *
     * @ORM\Column
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(length=60)
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=60)
     */
    private $fullName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Range(max="today")
     */
    private $birthdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var array
     *
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $permissions;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups="Signup")
     * @Assert\Length(min=8)
     */
    public $plainPassword;

    /**
     * @Assert\Callback()
     */
    public function checkPassword(ExecutionContextInterface $context) {
        if(false !== stripos($this->plainPassword, $this->username)) {
            $context
                ->buildViolation('user.password.username_detected')
                ->atPath('plainPassword')
                ->addViolation()
            ;
        }
    }

    public function grant($permission) {
        if(!isset($this->permissions) || !in_array($permission, $this->permissions)) {
            $this->permissions[] = $permission;
        }
    }

    public function revoke($permission) {
        if(false !== $key = array_search($permission, $this->permissions)) {
            unset($this->permissions[$key]);
        }
    }

    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->grant('ROLE_PLAYER');
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return User
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
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set permissions
     *
     * @param array $permissions
     * @return User
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * Get permissions
     *
     * @return array 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        $permissions = array();
        foreach($this->permissions as $permission) {
            if($permission instanceof RoleInterface) {
                $permissions[] = $permission;
            } else {
                $permissions[] = new Role($permission);
            }
        }
        return (array) $this->permissions;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
