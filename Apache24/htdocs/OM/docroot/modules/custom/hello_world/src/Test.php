<?php
namespace Drupal\hello_world;

class Test{
  protected $testargs;

  public function __construct(Avenger $testargs) {
    $this->testargs = $testargs;
  }

  public function runMe(){
    return "Running me...";
  }

  public function statChk(){
     return $this->testargs->revenge_thanos();
  }
}