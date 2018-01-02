<?php

namespace Drupal\drup_al\Session;

class NodeSessionManager
{
  public function getNodeId()
  {
    return \Drupal::request()->attributes->get('id');
  }
  
  public function getNodeRouteName()
  {
    return \Drupal::request()->attributes->get('_route');
  }
}