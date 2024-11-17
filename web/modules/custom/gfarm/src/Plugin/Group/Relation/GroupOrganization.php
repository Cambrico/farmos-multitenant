<?php

namespace Drupal\gfarm\Plugin\Group\Relation;

use Drupal\Core\Form\FormStateInterface;
use Drupal\group\Plugin\Group\Relation\GroupRelationBase;

/**
 * Provides a group relation type for farm organizations.
 *
 * @GroupRelationType(
 *   id = "group_organization",
 *   label = @Translation("Group farm organization"),
 *   description = @Translation("Adds farm organizations to groups both publicly and privately."),
 *   entity_type_id = "organization",
 *   entity_access = TRUE,
 *   reference_label = @Translation("Title"),
 *   reference_description = @Translation("The title of the organization to add to the group"),
 *   deriver = "Drupal\gfarm\Plugin\Group\Relation\GroupOrganizationDeriver",
 * )
 */
class GroupOrganization extends GroupRelationBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $config = parent::defaultConfiguration();
    $config['entity_cardinality'] = 1;
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    // Disable the entity cardinality field as the functionality of this module
    // relies on a cardinality of 1. We don't just hide it, though, to keep a UI
    // that's consistent with other group relations.
    $info = $this->t("This field has been disabled by the plugin to guarantee the functionality that's expected of it.");
    $form['entity_cardinality']['#disabled'] = TRUE;
    $form['entity_cardinality']['#description'] .= '<br /><em>' . $info . '</em>';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    $dependencies = parent::calculateDependencies();
    $dependencies['config'][] = 'organization.organization_type.' . $this->getRelationType()->getEntityBundle();
    return $dependencies;
  }

}
