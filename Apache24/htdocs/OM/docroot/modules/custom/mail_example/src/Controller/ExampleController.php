<?php
/**
 * @file
 * @author Rakesh James
 * Contains \Drupal\mail_example\Controller\ExampleController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 */
namespace Drupal\mail_example\Controller;
/**
 * Provides route responses for the Example module.
 */
class ExampleController {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function myPage() {
    $element = array(
      '#markup' => '',
    );
    return $element;
  }
}
?>