<?php

namespace Drupal\drupalup_simple_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Our simple form class.
 */
class SimpleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalup_simple_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['number_1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
    ];

    $form['number_2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Second name'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //drupal_set_message($form_state->getValue('number_1') + $form_state->getValue('number_2'));
    \Drupal::messenger()->addMessage('subbmited');
  }

}
