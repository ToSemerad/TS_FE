<?php

namespace App\EventSubscriber;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\Event\FilterUserResponseEvent;

class UserDefaultRoleSubscriber implements EventSubscriberInterface
{
    public function onSuccess(FormEvent $event)
    {
        $user = $event->getForm()->getData();
        $user->setRoles(['ROLE_AUTHOR']);
    }

    public static function getSubscribedEvents()
    {
        return [
           FOSUserEvents::REGISTRATION_SUCCESS => 'onSuccess',
        ];
    }
}
