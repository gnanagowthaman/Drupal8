<?php

namespace Drupal\diexample\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TeamWish extends ControllerBase {

  protected $account;

  public function __construct(AccountProxyInterface $account){
    $this->account = $account;
  }

  public static function create(ContainerInterface $container){
    return new static($container->get('current_user'));
  }

  public function callMe(){
    return [
      '#markup' => $this->account->getDisplayName(),
    ];
  }
}