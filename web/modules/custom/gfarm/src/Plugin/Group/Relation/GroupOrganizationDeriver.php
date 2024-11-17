<?php

namespace Drupal\gfarm\Plugin\Group\Relation;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\group\Plugin\Group\Relation\GroupRelationTypeInterface;
use Drupal\organization\Entity\OrganizationType;

/**
 * Provides a deriver for group_organization.
 */
class GroupOrganizationDeriver extends DeriverBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    assert($base_plugin_definition instanceof GroupRelationTypeInterface);
    $this->derivatives = [];

    foreach (OrganizationType::loadMultiple() as $name => $entity_type) {
      $label = $entity_type->label();

      $this->derivatives[$name] = clone $base_plugin_definition;
      $this->derivatives[$name]->set('entity_bundle', $name);
      $this->derivatives[$name]->set('label', $this->t('Farm organization (@type)', ['@type' => $label]));
      $this->derivatives[$name]->set('description', $this->t('Adds %type farm organizations to groups both publicly and privately.', ['%type' => $label]));
    }

    return $this->derivatives;
  }

}
