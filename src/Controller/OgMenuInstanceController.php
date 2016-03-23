<?php

/**
 * @file
 * Contains Drupal\og_menu\Controller\OgMenuInstanceController.
 */

namespace Drupal\og_menu\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Link;
use Drupal\og\OgGroupAudienceHelper;
use \Drupal\og_menu\Entity\OgMenu;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Url;
use Drupal\og_menu\Entity\OgMenuInstance;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


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

}
