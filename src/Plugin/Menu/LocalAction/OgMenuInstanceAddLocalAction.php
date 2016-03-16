<?php

/**
 * @file
 * Contains \Drupal\block_content\Plugin\Menu\LocalAction\BlockContentAddLocalAction.
 */

namespace Drupal\og_menu\Plugin\Menu\LocalAction;

use Drupal\Core\Menu\LocalActionDefault;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Routing\RouteProviderInterface;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Modifies the 'Add OG Menu instance' local action.
 */
class OgMenuInstanceAddLocalAction extends LocalActionDefault {
  use UrlGeneratorTrait;

  /**
   * Constructs a LocalActionDefault object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Routing\RouteProviderInterface $route_provider
   *   The route provider to load routes by name.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route of the current page.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RouteProviderInterface $route_provider, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $route_provider);

    $this->routeProvider = $route_provider;
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('router.route_provider'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    if ($this->routeMatch->getParameter('ogmenu')) {
      return 'entity.ogmenu_instance.add_form';
    }
    return $this->pluginDefinition['route_name'];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteParameters(RouteMatchInterface $route_match) {
    $route_params = parent::getRouteParameters($route_match);
    if ($ogmenu = $route_match->getParameter('ogmenu')) {
      $route_params['ogmenu'] = $ogmenu->id();
    }
    return $route_params;
  }

}
