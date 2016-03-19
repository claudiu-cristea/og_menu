<?php

/**
 * @file
 * Contains ogmenu_instance.page.inc..
 *
 * Page callback for OG Menu instance entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for OG Menu instance templates.
 *
 * Default template: ogmenu_instance.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ogmenu_instance(array &$variables) {
  // Fetch OgMenuInstance Entity Object.
  $ogmenu_instance = $variables['elements']['#ogmenu_instance'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}

/**
 * Prepares variables for a custom entity type creation list templates.
 *
 * Default template: ogmenu_instance-content-add-list.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - content: An array of ogmenu_instance-types.
 *
 * @see block_content_add_page()
 */
function template_preprocess_ogmenu_instance_content_add_list(&$variables) {
  $variables['types'] = array();
  $query = \Drupal::request()->query->all();
  foreach ($variables['content'] as $type) {
    $variables['types'][$type->id()] = array(
      'link' => Link::fromTextAndUrl($type->label(), new Url('entity.ogmenu_instance.add_form', array(
        'ogmenu' => $type->id(),
      ), array('query' => $query))),
      'description' => array(
        '#markup' => $type->label(),
      ),
      'title' => $type->label(),
      'localized_options' => array(
        'query' => $query,
      ),
    );
  }
}
