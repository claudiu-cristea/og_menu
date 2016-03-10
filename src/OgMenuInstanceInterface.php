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
interface OgMenuInstanceInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the OG Menu.
   *
   * @return string
   *   The OG Menu.
   */
  public function getType();

  /**
   * Gets the OG Menu instance name.
   *
   * @return string
   *   Name of the OG Menu instance.
   */
  public function getName();

  /**
   * Sets the OG Menu instance name.
   *
   * @param string $name
   *   The OG Menu instance name.
   *
   * @return \Drupal\og_menu\OgMenuInstanceInterface
   *   The called OG Menu instance entity.
   */
  public function setName($name);

  /**
   * Gets the OG Menu instance creation timestamp.
   *
   * @return int
   *   Creation timestamp of the OG Menu instance.
   */
  public function getCreatedTime();

  /**
   * Sets the OG Menu instance creation timestamp.
   *
   * @param int $timestamp
   *   The OG Menu instance creation timestamp.
   *
   * @return \Drupal\og_menu\OgMenuInstanceInterface
   *   The called OG Menu instance entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the OG Menu instance published status indicator.
   *
   * Unpublished OG Menu instance are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the OG Menu instance is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a OG Menu instance.
   *
   * @param bool $published
   *   TRUE to set this OG Menu instance to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\og_menu\OgMenuInstanceInterface
   *   The called OG Menu instance entity.
   */
  public function setPublished($published);

}
