<?php

namespace App\Security\Voter;

use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomerVoter extends Voter
{
    public const EDIT = 'CUSTOMER_EDIT';
    public const VIEW = 'CUSTOMER_VIEW';
    public const DELETE = 'CUSTOMER_DELETE';
    public const CREATE = 'CUSTOMER_CREATE';
    public const LIST = 'CUSTOMER_LIST';


    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        $permission = [self::EDIT, self::VIEW, self::DELETE];
        $permissionWithoutSubject = [self::CREATE, self::LIST];
        return in_array($attribute,$permissionWithoutSubject) || 
            (in_array($attribute, $permission)
            && $subject instanceof \App\Entity\Customer);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        $customer = $subject;
        $roles = $token->getRoleNames();

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                   return $this->canDo($user, $customer);
                break;

            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                return $this->canDo($user, $customer);
                break;
            case self::DELETE:
                    return $this->canDo($user, $customer);
                    break;
            case self::CREATE:
            case self::LIST:
                    return in_array("ROLE_USER",$roles);
                    break;
        }

        return false;
    }

    public function canDo($user,$subject):bool{
        return $user->getId()===$subject->getCreatedBy()->getId();
    }
}
