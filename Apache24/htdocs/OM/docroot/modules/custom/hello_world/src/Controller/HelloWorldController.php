<?php
namespace Drupal\hello_world\Controller;

use Drupal\hello_world\HelloWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;

/*
 * Controller for the salutation message.
 */
class HelloWorldController extends ControllerBase
{

  /**
   *
   * @var \Drupal\hello_world\HelloWorldSalutation
   */
  protected $salutation;

  /**
   * HelloWorldController constructor.
   *
   * @param \Drupal\hello_world\HelloWorldSalutation $salutation
   */
  public function __construct(HelloWorldSalutation $salutation)
  {
    $this->salutation = $salutation;
  }

  /**
   *
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static($container->get('hello_world.salutation'));
  }

  /*
   * Hello World.
   *
   * @return string
   */
  public function helloWorld()
  {
    return [
      '#markup' => $this->salutation->getSalutation()
    ];

    /* Controller returns a response directly
     * return new \Symfony\Component\HttpFoundation\Response('my text'); */

    /* redirect the browser to another page
     * return new \Symfony\Component\HttpFoundation\RedirectResponse('node/10'); */
  }
 }
