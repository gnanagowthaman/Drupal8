<?php
namespace Drupal\example_events\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\node\Entity\Node;

/**
 * Controller for Add Performance single tab.
 */
class EventSample extends ControllerBase {

  /**
   * Returns the add single performance form.
   */
  public function content() {
    $form = $this->formBuilder->getForm('Drupal\example_events\Form\DemoEventDispatchForm');
    return [
      '#type' => 'markup',
      '#markup' => $form
    ];
  }
}