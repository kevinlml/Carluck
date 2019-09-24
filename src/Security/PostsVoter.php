<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Carsad;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as SymfonyTokenInterface;

class PostsVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    /**
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {

        if(!in_array($attribute, [self::EDIT, self::DELETE]))
        {
            return false;
        }

        if(!$subject instanceof Carsad)
        {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, SymfonyTokenInterface $token)
    {
        if ($this->decisionManager->decide($token, [User::ROLE_ADMIN]))
        {
            return true;
        }

        $authenticatedUser =  $token->getUser();

        if(!$authenticatedUser instanceof User)
        {
            return false;
        }
        /**
         * @var Carsad $article
         */
        $article = $subject;

        return $article->getUser()->getId() === $authenticatedUser->getId();


    }
}