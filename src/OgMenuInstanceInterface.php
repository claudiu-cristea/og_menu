<?php

/**
 * @file
 * Contains \Drupal\og_menu\OgMenuInstanceInterface.
 */

namespace Drupal\og_menu;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining OG Menu instance entities.
 *
 * @ingroup og_menu
 */
interface OgMenuInstanceInterface extends ContentEntityInterface {
  /**
   * Gets the OG Menu.
   *
   * @return string
   *   The OG Menu.
   */
  public function getType();
}
