<?php

/**
 * @file
 * Contains \Drupal\menu_link_content\Controller\MenuController.
 */

namespace Drupal\og_menu\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\og_menu\OgMenuInstanceInterface;
use Drupal\og_menu\OgMenuInterface;

/**
 * Defines a route controller for a form for menu link content entity creation.
 */
class OgMenuController extends ControllerBase {

  /**
   * Provides the menu link creation form.
   *
   * @param \Drupal\system\MenuInterface $menu
   *   An entity representing a custom menu.
   *
   * @return array
   *   Returns the menu link creation form.
   */
  public function addLink(OgMenuInstanceInterface $ogmenu_instance) {
    $menu_link = $this->entityManager()->getStorage('menu_link_content')->create(array(
      'id' => '',
      'parent' => '',
      'menu_name' => 'ogmenu-' . $ogmenu_instance->id(),
      'bundle' => 'menu_link_content',
    ));
    return $this->entityFormBuilder()->getForm($menu_link);
  }

  /**
   * @param \Drupal\og_menu\OgMenuInterface $ogmenu
   *   The og menu object.
   * @return array
   *   The page title render array.
   */
  public static function title(OgMenuInterface $ogmenu) {
    return ['#markup' => $ogmenu->label(), '#allowed_tags' => Xss::getHtmlTagList()];
  }

}
