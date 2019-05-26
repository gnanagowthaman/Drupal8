<?php

namespace Drupal\mail_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

class ProductRegisterController extends ControllerBase{

  public function regProduct() {
    $element = array(
      '#theme' => 'my_template',
      '#test_var' => $this->t('Test Value'),
    );
    return $element;
  }

  public function prodDisplay() {
    $header_table = [
      'Product Id' => $this->t('Product Id'),
      'Product Title' => $this->t('Product Title'),
      'Min Age'       => $this->t('Min Age'),
      'Max Age'       => $this->t('Max Age'),
      'Gender'        => $this->t('Gender'),
      'Investment'    => $this->t('Investment'),
      'Annual income' => $this->t('Annual income'),
      'Operations'    => $this->t('Operations'),
    ];

    $query = \Drupal::database()->select('mail_example', 'm');
    $query->fields('m', ['pid','producttitle','minage','maxage','gender','investment','annualincome']);
    $results = $query->execute()->fetchAll();

    $rows = [];

    foreach($results as $data){
      $edit   = Url::fromUserInput('/mypage/register?num='.$data->pid);

      $rows[] = [
        'pid' =>$data->pid,
        'producttitle' => $data->producttitle,
        'minage' => $data->minage,
        'maxage' => $data->maxage,
        'gender' => $data->gender,
        'investment' => $data->investment,
        'annualincome' => $data->annualincome,
        \Drupal::l('Edit', $edit),
      ];

    }

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header_table,
      '#rows' => $rows,
      '#empty' => t('No users found'),
    ];

    return $form;
  }

}