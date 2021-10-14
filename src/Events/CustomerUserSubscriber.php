<?php

namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Customer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class CustomerUserSubscriber implements EventSubscriberInterface{

    private $security;

   public function __construct(Security $security)
   {
        $this->security = $security;
   }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setUserForCustomer', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function SetUserForCustomer(ViewEvent $event){

        $customer = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        $this->security->getUser();

        if($customer instanceof  Customer && $method === "POST"){

            // Connaitre l'utilisateur actuellement connecté
            $user = $this->security->getUser();
            // Assigner l'utilisateur au Customer qu'on est en train de créer
            $customer->setUser($user);
        }


        //dd($result);
    }
}