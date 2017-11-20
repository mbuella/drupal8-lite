<?php
/**
 * @file
 * Contains \Drupal\drup_al\Controller\PostController.
 */
namespace Drupal\drup_al\Controller;

class PostController {
  public function listPost() {
    return array(
      '#theme' => 'post_list',
      '#posts' => t('Hello, World!'),
    );
  }
}