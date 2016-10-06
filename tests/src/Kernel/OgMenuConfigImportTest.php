<?php

/**
 * @file
 * Contains \Drupal\Tests\og_menu\Kernel\OgMenuConfigImportTest.
 */

namespace Drupal\Tests\og_menu\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\og\OgGroupAudienceHelper;

/**
 * @group og_menu
 */
class OgMenuConfigImportTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'field',
    'og',
    'og_menu',
    'system',
    'user',
    'node'
  ];

  public function testModuleInstallationWithDefaultConfig() {
    \Drupal::service('module_installer')->install(['og_menu_test']);
    $this->assertArrayHasKey(OgGroupAudienceHelper::DEFAULT_FIELD, \Drupal::service('entity_field.manager')->getFieldStorageDefinitions('ogmenu_instance'));
  }

}
