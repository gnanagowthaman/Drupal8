<?php

namespace Drupal\mail_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 *
 * @author OmNamashivaya
 *
 * @Block(
 *  id= "mail_example_block",
 *  admin_label = @Translation("Example block"),
 *  category = @Translation("Custom example block")
 * )
 */
class MailExampleBlock extends BlockBase {

  /**
   *
   * {@inheritDoc}
   * @see \Drupal\Core\Block\BlockPluginInterface::build()
   */
  public function build()
  {
    $form = \Drupal::formBuilder()->getForm('Drupal\mail_example\Form\MailExampleForm');
    $form = \Drupal::formBuilder()->getForm('Drupal\mail_example\Form\RegisterForm');
    return $form;
  }
}