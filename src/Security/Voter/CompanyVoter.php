<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CompanyVoter extends Voter
{
    public const EDIT = 'COMPANY_EDIT';
    public const VIEW = 'COMPANY_VIEW';
    public const DELETE = 'COMPANY_DELETE';
    public const CREATE = 'COMPANY_CREATE';
    public const LIST = 'COMPANY_LIST';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        $permission =[self::EDIT, self::VIEW, self::DELETE];
        $permissionWithoutSubject = [self::CREATE, self::LIST];
        return in_array($attribute, $permissionWithoutSubject) || 
            (in_array($attribute, $permission)
            && $subject instanceof \App\Entity\Company);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof \App\Entity\User) {
            return false;
        }
        $company = $subject;
            
        switch ($attribute) {
            case self::EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                return $user->getId()===$company->getOwner()->getId();
                break;

            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                return $user->getId()===$company->getOwner()->getId();
                break;
            case self::DELETE:
                return $user->getId()===$company->getOwner()->getId();
                break;
            case self::CREATE:
            case self::LIST:
                return true;
                break;
        }
        return false;
    }
}
