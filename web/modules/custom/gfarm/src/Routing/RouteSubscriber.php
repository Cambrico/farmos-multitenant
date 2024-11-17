<?php

namespace Drupal\gfarm\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Subscriber for Group Farm Organization routes.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.group_relationship.create_page')) {
      $copy = clone $route;
      $copy->setPath('group/{group}/organizations/create');
      $copy->setDefault('base_plugin_id', 'group_organization');
      $collection->add('entity.group_relationship.group_organization_create_page', $copy);
    }
    if ($route = $collection->get('entity.group_relationship.add_page')) {
      $copy = clone $route;
      $copy->setPath('group/{group}/organizations/add');
      $copy->setDefault('base_plugin_id', 'group_organization');
      $collection->add('entity.group_relationship.group_organization_add_page', $copy);
    }
  }

}
