<?php
namespace Drupal\hello_world\EventSubscriber;

use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Url;
use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\hello_world\Test;

/**
 * Subsribes to the kernel Request event and redirects to the
 *  homepage when the user has the "non_grata" role.
 */
class HelloWorldRedirectSubscriber implements EventSubscriberInterface {
  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;
  /**
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $currentRouteMatch;
  /**
   * @var \Drupal\hello_world\Test
   */
  protected $testMe;
  /**
   * HelloWorldRedirectSubscriber constructor.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $currentuser
   * @param \Drupal\Core\Routing\CurrentRouteMatch $currentRouteMatch
   * @param \Drupal\hello_world\Test $testMe
   */
  public function __construct(AccountProxyInterface $currentuser,CurrentRouteMatch $currentRouteMatch) {
    $this->currentUser = $currentuser;
    $this->currentRouteMatch = $currentRouteMatch;
    //$this->testMe = $testMe;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events['kernel.request'][] = ['onRequest', 0];
    return $events;
  }

  /**
   * Handler for the kernel request event.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
    $route_name = $this->currentRouteMatch->getRouteName();
    if($route_name !== 'hello_world.hello'){
      return;
    }
    $roles=$this->currentUser->getRoles();
    if(in_array('non_grata', $roles)){
      $url=Url::fromUri('internal:/');
      $test_message=$this->testMe->msg();
      print $test_message;
      $event->setResponse(new LocalRedirectResponse($url->toString()));
    }
  }
  /* public function onRequest(GetResponseEvent $event) {
    $request = $event->getRequest();
    $path = $request->getPathInfo();
    if ($path !== '/hello') {
      return;
    }

    $roles = $this->currentUser->getRoles();
    if (in_array('non_grata', $roles)) {
      $event->setResponse(new RedirectResponse('/'));
    }
  } */
}