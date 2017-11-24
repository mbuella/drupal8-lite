<?php
/**
 * @file
 * Contains \Drupal\drup_al\Controller\PostController.
 */
namespace Drupal\drup_al\Controller;

use Drupal\drup_al\Entity\Manager\PostManager;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostController extends ControllerBase {
  
  private $postManager;
  protected $loggerFactory;
  
  public function __construct($services) {
    if(count($services) > 0) {
      $this->postManager = $services['postManager'];
      $this->loggerFactory = $services['loggerFactory'];      
    }
  }
  
  public static function create(ContainerInterface $container) {
    return new static(
      array(
        'postManager' => $container->get('drup_al.post_manager'),
        'loggerFactory' => $container->get('logger.factory'),
      )
    );
  }
  
  public function listPost() {
    $postList = [];
    
    // fetch nodes using the ids    
    $entities = $this->postManager->getPosts();
    
    //log fetching of post
    $this->loggerFactory
         ->get('drup_al') //channel
         ->info(
          '@count posts has been loaded successfully',
          array(
            '@count' => count($entities)
          )
         );
    
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
    $entity = $this->postManager->getPost($id);
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