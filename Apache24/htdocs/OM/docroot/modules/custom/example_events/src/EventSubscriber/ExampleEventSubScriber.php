<?php
namespace Drupal\example_events\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\example_events\ExampleEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExampleEventSubScriber implements EventSubscriberInterface{
  public static function getSubscribedEvents()
  {
    $events[ConfigEvents::SAVE][] = array('onSavingConfig', 800);
    $events[ExampleEvent::SUBMIT][] = array('doSomeAction', 800);
    return $events;
  }

  public function doSomeAction(ExampleEvent $event) {
    drupal_set_message('Wish you many more happy returns of the day ' . $event->getReferenceID() . ', on behalf of priyadarshini & gnanagowthaman');
  }

  public function onSavingConfig(ConfigCrudEvent $event) {
    drupal_set_message("You have saved a configuration of " . $event->getConfig()->getName());
  }
}