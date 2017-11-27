<?php

namespace Drupal\drup_al\Entity\Manager;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostManager
{
  public function getPosts()
  {
    //fetch ids (nids), with conditions (type of post)
    $query = \Drupal::entityQuery('node')
                      ->condition('type', 'post');
    $nids = $query->execute();
    
    // fetch nodes using the ids
    return entity_load_multiple('node', $nids);
  }
  
  public function getPost($id)
  {
    if($post = entity_load('node', $id)) {
      return $post;      
    }
    //throw post not found
    throw new NotFoundHttpException("That post does not exist!");
  }
}