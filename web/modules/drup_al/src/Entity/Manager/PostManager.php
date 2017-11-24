<?php

namespace Drupal\drup_al\Entity\Manager;

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
    return entity_load('node', $id);
  }
}