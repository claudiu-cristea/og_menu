<?php
/**
 * @file
 * Contains \Drupal\og_menu\ContextProvider\OgRouteContext.
 */

namespace Drupal\og_menu\ContextProvider;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Plugin\Context\Context;
use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\Core\Plugin\Context\ContextProviderInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\og\Og;

/**
 * Sets the current og as a context.
 */
class OgRouteContext implements ContextProviderInterface {

  use StringTranslationTrait;

  /**
   * The route match object.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a new CollectionRouteContext.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match object.
   */
  public function __construct(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public function getRuntimeContexts(array $unqualified_context_ids) {
    $result = [];
    $context_definition = new ContextDefinition('entity', $this->t('Organic group'), FALSE);
    $value = NULL;
    foreach ($this->routeMatch->getParameters() as $parameter) {
      if ($parameter instanceof EntityInterface) {
        /** @var \Drupal\Core\Entity\EntityInterface $entity */
        $entity = $parameter;
        $entity_type = $entity->getEntityTypeId();
        $entity_bundle = $entity->bundle();
        if (Og::isGroup($entity_type, $entity_bundle)) {
          $value = $entity;
        }
      }
    }

    $cacheability = new CacheableMetadata();
    $cacheability->setCacheContexts(['route']);

    $context = new Context($context_definition, $value);
    $context->addCacheableDependency($cacheability);

    $result['og'] = $context;

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getAvailableContexts() {
    $context = new Context(new ContextDefinition('og', $this->t('Organic group from path')));
    return ['og' => $context];
  }

}
