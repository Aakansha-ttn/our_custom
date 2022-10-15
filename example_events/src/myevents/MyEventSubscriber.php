<?php

namespace Drupal\example_events\myevents;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;
use Drupal\user\Entity\User;
Use Drupal\Core\Session\AccountInterface;


class MyEventSubscriber implements EventSubscriberInterface{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onResponse',
            ConfigEvents::SAVE => 'configSave',
            KernelEvents::REQUEST => 'redirect',
        ];
    }
    public function onResponse(){
        \Drupal::messenger()->addStatus("event testing");
       
    }
    public function Configsave() {
        \Drupal::messenger()->addStatus("Save event is called");
    }
    public function redirect(GetResponseEvent $event) {
        $current_user = \Drupal::currentUser();
$user_roles = $current_user->getRoles();
$name = $current_user->getAccountName();
        // $user_roles = \Drupal::currentUser()->getRoles();
        // dump($current_user);die;
        $request = $event->getRequest();
                // kint($request->server);die;
                $path = $request->getPathInfo();
            //     if(in_array("anonymous", $current_user) && ($path == '/book-listing')){
                
            //         $event->setResponse(new RedirectResponse('/drupal_cms/drupal9/web/listing'));
                
            //  }
            // dump($path);die;
            // $user = User::load(\Drupal::currentUser()->id());
            // dump($user);die;

            
            // if(in_array("authenticated", $user_roles) && ($path == '/listing')){

            //     $node = Node::create(array(
            //         'type' => 'article',
            //         'title' => $name." ". date('d-m-Y, h:i:sa',REQUEST_TIME),
            //         // 'title' => AccountInterface::getAccountName().date('d-m-Y, h:i:sa',REQUEST_TIME),


            //         'body' => 'test body',
            //         'status' => 0,
            //         'uid' => 2,

            //       ));
                  
            //       $node->save();
            //       \Drupal::messenger()->addStatus("Node Created");
    
            //  }
    

}
}