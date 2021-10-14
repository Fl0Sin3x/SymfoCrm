<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        // 1. Récuperé l'utilisateur (pour voir son nom et prénoms)
        $user = $event->getUser();

        // 2. Enrichir les data pour qu'elles contiennent ses données
        $data = $event->getData();
        $data['firstName'] = $user->getFirstName();
        $data['lastName'] = $user->getLastName();

        $event->setData($data);
        //dd($event->getData());
    }
}