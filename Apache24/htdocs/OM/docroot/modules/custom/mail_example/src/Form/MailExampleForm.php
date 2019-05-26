<?php
namespace Drupal\mail_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MailExampleForm for demonstration.
 */
class MailExampleForm extends FormBase {

  /**
   *
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'mail_example_product_id';
  }

  /**
   *
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['#prefix'] = '<div class="product-form">';
    $form['#suffix'] = '</div>';
    $form['age'] = [
      '#type' => 'select',
      '#title' => $this->t('Select element'),
      '#options' => [
        '10' => $this->t('10'),
        '20' => $this->t('20')
      ],
      '#required' => TRUE
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Select element'),
      '#options' => [
        'm' => $this->t('male'),
        'f' => $this->t('female')
      ],
      '#required' => TRUE
    ];

    $form['income'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Income Need'),
      '#default_value' => $this->t('0'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#prefix' => '<div class="subt-frm">',
      '#suffix' => '</div>',
      '#type' => 'submit',
      '#value' => $this->t('Calculate')
    ];

    return $form;
  }

  /**
   *
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->messenger()->addMessage($this->t('Form submitted successfully'));
  }
}
