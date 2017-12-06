<?php

namespace Drupal\drup_al\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $routeCtrlr = array(
      //'<front>' => 'Drupal\drup_al\Controller\MainController::index',
    );
    foreach($routeCtrlr as $route => $controller) {
      if ($route = $collection->get($route)) {
        $route->setDefault('_controller', $controller);
      }      
    }
  }

}