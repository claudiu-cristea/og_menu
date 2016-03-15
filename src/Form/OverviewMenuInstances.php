<?php

/**
 * @file
 * Contains \Drupal\taxonomy\Form\OverviewTerms.
 */

namespace Drupal\og_menu\Form;

use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\og_menu\OgMenuInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides terms overview form for a taxonomy vocabulary.
 */
class OverviewMenuInstances extends FormBase {

  /**
   * The module handler service.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * The term storage controller.
   *
   * @var \Drupal\taxonomy\TermStorageInterface
   */
  protected $storageController;

  /**
   * Constructs an OverviewTerms object.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler service.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager service.
   */
  public function __construct(EntityManagerInterface $entity_manager) {
    $this->entityManger = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ogmenu_overview_instances';
  }

  /**
   * Form constructor.
   */
  public function buildForm(array $form, FormStateInterface $form_state, OgMenuInterface $ogmenu = NULL) {
    $og_instance_storage = $this->entityManger->getStorage('ogmenu_instance');
    $query = $og_instance_storage->getQuery()
      ->sort('id')
      ->condition('type', $ogmenu->id())
      ->pager(10);

    $rids = $query->execute();
    $entities = $og_instance_storage->loadMultiple($rids);
    $list = array('#theme' => 'item_list');
    /** @var \Drupal\Core\Entity\EntityInterface $entity */
    foreach ($entities as $entity) {
      $list['#items'][] = array('#markup' => $entity->link());
    }

    $build = array(
      'list' => $list,
    );


    return $build;
  }

  /**
   * Form submission handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
