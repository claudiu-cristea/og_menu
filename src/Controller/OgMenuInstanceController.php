<?php

/**
 * @file
 * Contains Drupal\og_menu\Controller\OgMenuInstanceController.
 */

namespace Drupal\og_menu\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\og\Og;
use Drupal\og\OgGroupAudienceHelper;
use Drupal\og_menu\Entity\OgMenu;
use Drupal\og_menu\Entity\OgMenuInstance;
use Drupal\og_menu\OgMenuInstanceInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class OgMenuInstanceController.
 *
 * @package Drupal\og_menu\Controller
 */
class OgMenuInstanceController extends ControllerBase {
  public function __construct(EntityStorageInterface $storage, EntityStorageInterface $type_storage) {
    $this->storage = $storage;
    $this->typeStorage = $type_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /** @var EntityManagerInterface $entity_manager */
    $entity_manager = $container->get('entity.manager');
    return new static(
      $entity_manager->getStorage('ogmenu_instance'),
      $entity_manager->getStorage('ogmenu')
    );
  }

  public function createMenuInstance(OgMenu $ogmenu, EntityInterface $og_group) {
    $values = [
      'type' => $ogmenu->id(),
      OgGroupAudienceHelper::DEFAULT_FIELD => $og_group->id(),
    ];
    // Menu exists, redirect to edit form.
    $instances = $this->storage->loadByProperties($values);
    if ($instances) {
      $instance = array_pop($instances);
      return $this->redirect('entity.ogmenu_instance.edit_form', [
        'ogmenu_instance' => $instance->id(),
      ]);
    }

    // Create new menu instance.
    $entity = OgMenuInstance::create($values);
    $entity->save();
    if ($entity->id()) {
      return $this->redirect('entity.ogmenu_instance.edit_form', [
        'ogmenu_instance' => $entity->id(),
      ]);
    }
    throw new Exception('Unable to save menu instance.');
  }

  /**
   * Provides the menu link creation form.
   *
   * @param \Drupal\og_menu\OgMenuInstanceInterface $ogmenu_instance
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
   * Route title callback.
   *
   * @param \Drupal\rdf_entity\RdfInterface $rdf_entity
   *   The rdf entity.
   *
   * @return array
   *   The rdf entity label as a render array.
   */
  public function editFormTitle(OgMenuInstanceInterface $ogmenu_instance) {
    return ['#markup' => t('Edit menu %menu of %group', [
      '%menu' => $ogmenu_instance->bundle(),
      '%group' =>$ogmenu_instance->label()
    ]), '#allowed_tags' => Xss::getHtmlTagList()];
  }

  /**
   * Access callback for the "add link" route.
   *
   * @param \Drupal\og_menu\Entity\OgMenuInstance $ogmenu_instance
   *   The OG Menu instance for which to determine access.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user for which to determine access.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   */
  public function addLinkAccess(OgMenuInstance $ogmenu_instance, AccountInterface $account) {
    // @todo Add per-bundle permissions. You might want to give users access to
    //   add links to a particular OG Menu, but not all of them.
    $permission = 'add new links to og menu instance entities';

    // If the user has the global permission, allow access immediately.
    if ($account->hasPermission($permission)) {
      return AccessResult::allowed();
    }

    // Retrieve the associated group from the menu instance.
    $og_groups = Og::getGroups($ogmenu_instance);
    // A menu should only be associated with a single group.
    $group_entity_type = key($og_groups);
    $og_group = reset($og_groups[$group_entity_type]);

    // If the group could not be found, access could not be determined.
    if (empty($og_group)) {
      return AccessResult::neutral();
    }

    $membership = Og::getUserMembership($account, $og_group);
    // If the membership can not be found, access can not be determined.
    if (empty($membership)) {
      return AccessResult::neutral();
    }

    return AccessResult::allowedIf($membership->hasPermission($permission));
  }

}
