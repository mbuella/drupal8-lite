<?php
/**
 * @file
 * Contains \Drupal\drup_al\Controller\PostController.
 */
namespace Drupal\drup_al\Controller;

use Drupal\Core\Controller\ControllerBase;

class MainController extends ControllerBase {  
  public function index() {
    
    // dump('Home');
    // die();
    
    return array(
      '#theme' => 'main_index',
      // '#posts' => $postList,
    );
  }
  
  
  /*** ERROR ROUTES ***/
  
  public function error404() {
    return array(
      '#theme' => 'error_404',
      // '#posts' => $postList,
    );
  }
  
}