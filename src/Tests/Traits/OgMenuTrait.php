<?php

namespace Drupal\og_menu\Tests\Traits;

use Drupal\menu_link_content\Entity\MenuLinkContent;
use Drupal\og\OgGroupAudienceHelperInterface;
use Drupal\og_menu\Entity\OgMenuInstance;
use Drupal\og_menu\OgMenuInstanceInterface;

/**
 * Helper methods to use in OG Menu tests.
 */
trait OgMenuTrait {

  /**
   * Retrieves an OG Menu instance from the database.
   *
   * @param string $group_id
   *   The group id of the parent entity.
   * @param string $type
   *   The OG Menu bundle.
   *
   * @return \Drupal\og_menu\OgMenuInstanceInterface|null
   *    The menu instance as retrieved from the database, or NULL if no instance
   *    is found.
   */
  protected function getOgMenuInstance($group_id, $type) {
    $values = [
      'type' => $type,
      OgGroupAudienceHelperInterface::DEFAULT_FIELD => $group_id,
    ];

    $instances = \Drupal::entityTypeManager()->getStorage('ogmenu_instance')->loadByProperties($values);

    return !empty($instances) ? array_pop($instances) : NULL;
  }

  /**
   * Created an OG Menu instance for a given group.
   *
   * @param string $group_id
   *    The id of the group that this menu will belong to.
   * @param string $type
   *   The OG Menu bundle.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *    The newly created menu instance.
   *
   * @throws \Exception
   *    If the saving was unsuccessful.
   */
  protected function createOgMenuInstance($group_id, $type) {
    $values = [
      'type' => $type,
      OgGroupAudienceHelperInterface::DEFAULT_FIELD => $group_id,
    ];

    $og_menu_instance = OgMenuInstance::create($values);
    $og_menu_instance->save();
    if ($og_menu_instance->id()) {
      return $og_menu_instance;
    }
    throw new \Exception('Unable to save menu instance.');
  }

  /**
   * Creates a menu link.
   *
   * Used to create menu links for og menu instances.
   * The $item data is an array ready to be passed to the
   * MenuLinkContent::create method.
   *
   * @code
   *
   * $item_data = [
   *  'title' => 'My label for the menu',
   *  'link' => [
   *     'uri' => '/path/of/menu/item',
   *   ],
   *   'menu_name' => menu_machine_name,
   *   'weight' => 1,
   *   'expanded' => TRUE,
   * ];
   *
   * @end_code
   *
   * @param array $item_data
   *    The item data.
   *
   * @see \Drupal\menu_link_content\Entity\MenuLinkContent::create()
   */
  protected function createOgMenuItem(array $item_data) {
    $menu_link = MenuLinkContent::create($item_data);
    $menu_link->save();
  }

}
