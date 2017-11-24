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
    $entities = entity_load_multiple('node', $nids);
    
    // loop through the fetch nodes
    foreach($entities as $entity) {
      $postList[] = array(
        'id' => $entity->id(),
        'title' => $entity->get('title')->value,
        'intro' => $entity->get('body')->summary,
        // 'slug' => $entity->get('field_post_slug')->value,
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
  
  public function viewPost($id) {
    //load post using id
    $entity = entity_load('node', $id);
    $post = array(
        // 'id' => $entity->id(),
        'title' => $entity->get('title')->value,
        'content' => $entity->get('body')->value,
        // 'slug' => $entity->get('field_post_slug')->value,
        // title value of the category entity reference (entity field)
        'category' => $entity->get('field_post_category')->entity->get('title')->value,
      );
      
    // dump($post);
    
    return array(
      '#theme' => 'post_view',
      '#post' => $post,
    );
  }
}