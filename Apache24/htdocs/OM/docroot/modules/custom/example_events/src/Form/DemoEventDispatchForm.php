<?php
namespace Drupal\example_events\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\example_events\ExampleEvent;

class DemoEventDispatchForm extends FormBase{

  public function getFormId()
  {
    return "demo_event_dispatch_form";
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $dispatcher = \Drupal::service('event_dispatcher');
    $event = new ExampleEvent($form_state->getValue('name'));
    $dispatcher ->dispatch(ExampleEvent::SUBMIT,$event);
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Reference'),
      '#description' => $this->t('Type something here that will be set to the event object, while subscribing it.'),
      '#maxlength' => 64,
      '#size' => 64,
    );
    $form['dispatch'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Dispatch'),
    );
    return $form;
  }

}