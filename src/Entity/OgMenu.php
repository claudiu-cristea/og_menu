<?php

/**
 * @file
 * Contains \Drupal\og_menu\Entity\OgMenu.
 */

namespace Drupal\og_menu\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\og_menu\OgMenuInterface;

/**
 * Defines the OG Menu entity.
 *
 * @ConfigEntityType(
 *   id = "ogmenu",
 *   label = @Translation("OG Menu"),
 *   handlers = {
 *     "list_builder" = "Drupal\og_menu\OgMenuListBuilder",
 *     "form" = {
 *       "add" = "Drupal\og_menu\Form\OgMenuForm",
 *       "edit" = "Drupal\og_menu\Form\OgMenuForm",
 *       "delete" = "Drupal\og_menu\Form\OgMenuDeleteForm"
 *     }
 *   },
 *   config_prefix = "ogmenu",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "ogmenu_instance",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/ogmenu/{ogmenu}",
 *     "edit-form" = "/admin/structure/ogmenu/{ogmenu}/edit",
 *     "delete-form" = "/admin/structure/ogmenu/{ogmenu}/delete",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class OgMenu extends ConfigEntityBundleBase implements OgMenuInterface {
  /**
   * The OG Menu ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The OG Menu label.
   *
   * @var string
   */
  protected $label;

}
