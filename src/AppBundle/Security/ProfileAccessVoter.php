<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 23/01/2015
 * Time: 10:03
 */

namespace AppBundle\Security;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileAccessVoter extends AbstractVoter
{

    private $hierarchy;

    public function __construct(RoleHierarchyInterface $hierarchy) {
        $this->hierarchy = $hierarchy;
    }
    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return [ "AppBundle\Entity\User" ];
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return [ "ACCESS_PROFILE"];
    }

    /**
     * Perform a single access check operation on a given attribute, object and (optionally) user
     * It is safe to assume that $attribute and $object's class pass supportsAttribute/supportsClass
     * $user can be one of the following:
     *   a UserInterface object (fully authenticated user)
     *   a string               (anonymously authenticated user)
     *
     * @param string $attribute
     * @param object $object
     * @param UserInterface|string $user
     *
     * @return bool
     */
    protected function isGranted($attribute, $profile, $user = null)
    {
        if (null === $user || !$user instanceof User) {
            return false;
        }

        if(!$profile instanceof User) {
            return false;
        }

        if($profile->getUsername() === $user->getUsername()) {
            return true;
        }

        $roles = array_map(function(RoleInterface $role) {
           return $role->getRole();
        }, $this->hierarchy->getReachableRoles($user->getRoles()));

        return in_array('ROLE_ADMIN', $roles);
    }
}