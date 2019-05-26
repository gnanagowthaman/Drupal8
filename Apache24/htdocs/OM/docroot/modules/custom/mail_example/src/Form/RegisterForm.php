<?php
namespace Drupal\mail_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\mail_example\RegisterationValidation;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterForm extends FormBase
{

  protected $registerationValidation;

  public function getFormId()
  {
    return 'mail_example_register_id';
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $field_prdoct_title = $form_state->getValue('producttitle');
    $field_min_age = $form_state->getValue('minage');
    $field_max_age = $form_state->getValue('maxage');
    $field_gender = $form_state->getValue('gender');
    $field_investment = $form_state->getValue('investment');
    $field_annualincome = $form_state->getValue('annualincome');

    if (isset($_GET['num'])) {
      $field  = array(
        'producttitle' => $field_prdoct_title,
        'minage' => $field_min_age,
        'maxage' => $field_max_age,
        'gender' => $field_gender,
        'investment' => $field_investment,
        'annualincome' => $field_annualincome,
      );

      $query = \Drupal::database();
      $query->update('mail_example')
      ->fields($field)
      ->condition('id', $_GET['num'])
      ->execute();
      $this->messenger()->addMessage($this->t('Updated successfully'));
      $form_state->setRedirect('mail_example.display');
    }
    else {
      if (isset($field_prdoct_title) && isset($field_min_age) && isset($field_max_age) && isset($field_gender) &&   isset($field_investment) && isset($field_annualincome)) {
        \Drupal::database()->insert('mail_example')
        ->fields([
          'producttitle',
          'minage',
          'maxage',
          'gender',
          'investment',
          'annualincome'
        ])
        ->values([
          $field_prdoct_title,
          $field_min_age,
          $field_max_age,
          $field_gender,
          $field_investment,
          $field_annualincome
        ])
        ->execute();
        $this->messenger()->addMessage($this->t('Saved successfully'));
        $response = new RedirectResponse("/mypage/display");
        $response->send();
      } else {
        return '';
      }
    }
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $conn = Database::getConnection();
    $record = [];
    if (isset($_GET['num'])) {
      $query = $conn->select('mail_example', 'm')
      ->condition('pid', $_GET['num'])
      ->fields('m');
      $record = $query->execute()->fetchAssoc();
    }

    $form['#prefix'] = '<div class="product-register">';
    $form['#suffix'] = '</div>';

    $form['producttitle'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Title'),
      '#default_value' => (isset($record['producttitle']) && $_GET['num']) ? $record['producttitle']:'',
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['minage'] = [
      '#type' => 'select',
      '#title' => $this->t('Min Age'),
      '#options' => [
        '10' => $this->t('10'),
        '20' => $this->t('20'),
        '25' => $this->t('25'),
        '30' => $this->t('30'),
        '35' => $this->t('35'),
        '40' => $this->t('40'),
        '45' => $this->t('45'),
        '50' => $this->t('50'),
        '55' => $this->t('55'),
        '60' => $this->t('60'),
        '65' => $this->t('65'),
        '#default_value' => (isset($record['minage']) && $_GET['num']) ? $record['minage']:'',
      ],
    ];

    $form['maxage'] = array (
      '#type' => 'select',
      '#title' => $this->t('Max Age'),
      '#options' => array (
        '10' => $this->t('10'),
        '20' => $this->t('20'),
        '25' => $this->t('25'),
        '30' => $this->t('30'),
        '35' => $this->t('35'),
        '40' => $this->t('40'),
        '45' => $this->t('45'),
        '50' => $this->t('50'),
        '55' => $this->t('55'),
        '60' => $this->t('60'),
        '65' => $this->t('65'),
        '#default_value' => (isset($record['maxage']) && $_GET['num']) ? $record['maxage']:'',
      ),
    );

    $form['gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'm' => t('Male'),
        'f' => t('Female'),
        '#default_value' => (isset($record['gender']) && $_GET['num']) ? $record['gender']:'',
      ),
    );

    $form['investment'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Investment'),
      '#default_value' => (isset($record['investment']) && $_GET['num']) ? $record['investment']:'',
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['annualincome'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Annual income'),
      '#default_value' => (isset($record['annualincome']) && $_GET['num']) ? $record['annualincome']:'',
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#prefix' => '<div class="subt-frm">',
      '#suffix' => '</div>',
      '#type' => 'submit',
      '#value' => $this->t('Save')
    ];
    return $form;
  }
}