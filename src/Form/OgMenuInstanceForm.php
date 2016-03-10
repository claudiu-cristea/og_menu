<?php

/**
 * @file
 * Contains \Drupal\og_menu\Form\OgMenuInstanceForm.
 */

namespace Drupal\og_menu\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for OG Menu instance edit forms.
 *
 * @ingroup og_menu
 */
class OgMenuInstanceForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\og_menu\Entity\OgMenuInstance */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label OG Menu instance.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label OG Menu instance.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.ogmenu_instance.edit_form', ['ogmenu_instance' => $entity->id()]);
  }

}
