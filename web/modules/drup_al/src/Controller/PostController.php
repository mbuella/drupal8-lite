<?php
/**
 * @file
 * Contains \Drupal\drup_al\Controller\PostController.
 */
namespace Drupal\drup_al\Controller;

class PostController {
  public function listPost() {
    $postList = [];
    
    //fetch ids (nids), with conditions (type of post)
    $query = \Drupal::entityQuery('node')
                      ->condition('type', 'post');
    $nids = $query->execute();
    
    // fetch nodes using the ids
    $node_storage = \Drupal::entityManager()->getStorage('node'); 
    $mult = $node_storage->loadMultiple($nids);
    
    
    // loop through the fetch nodes
    foreach($mult as $entity) {
      $postList[] = array(
        'title' => $entity->get('title')->value,
        'intro' => $entity->get('body')->summary,
        // title value of the category entity reference (entity field)
        'category' => $entity->get('field_post_category')->entity->get('title')->value,
      );
    }
    
    // dump($postList);    
    
    return array(
      '#theme' => 'post_list',
      '#posts' => $postList,
    );
  }
}