<?php

/**
 * @file
 * Contains \Drupal\og_menu\OgMenuInstanceListBuilder.
 */

namespace Drupal\og_menu;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of OG Menu instance entities.
 *
 * @ingroup og_menu
 */
class OgMenuInstanceListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('OG Menu instance ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\og_menu\Entity\OgMenuInstance */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.ogmenu_instance.edit_form', array(
          'ogmenu_instance' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
