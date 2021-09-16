<?php
namespace Drupal\assignment\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Controller for JSON Response of a given node
 */
class PageJson extends ControllerBase {
  public function jsonPage($apikey, $nid) {
    $siteapikey = \Drupal::config('system.site')->get('siteapikey');
    $node = \Drupal\node\Entity\Node::load($nid);
    if($node){
      $content_type = $node->getType();
    }
    // Printing Access Denied in case of incorrect siteapikey or node id in URL
    if($siteapikey != $apikey || $content_type != "page"){
      print "Access Denied";
      exit();
    }
    // JSON Response of given node
    else{
      $result[] = [
        "id" => $node->body->value,
        "title" => $node->getTitle(),
      ];
      return new JsonResponse($result);
    } 
  }
}

?>