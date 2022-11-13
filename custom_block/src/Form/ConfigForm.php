<?php

namespace Drupal\custom_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

class ConfigForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
          'student_config_form.adminsettings',
        ];
      }
    public function getFormId()
    {
        return 'student_config_form';
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('student_config_form.adminsettings');

        $form['student_name'] = array(
            '#type' => 'select',
            '#title' => t('Select Name:'),
            '#default_value' => $config->get('student_name'),
            '#required' => TRUE,
            '#options' => ['Aakansha' => $this->t('Aakansha'),  'Deepak'=> $this->t('Deepak'), 'Rakhi' => $this->t('Rakhi'), 'Pakhi' => $this->t('Pakhi'), 'Shyam' => $this->t('Shyam'), 'Ram' => $this->t('Ram'), 'Mohan' => $this->t('Mohan')],
        );
        $form['student_rollno'] = array(
            '#type' => 'select',
            '#title' => t('Select Enrollment Number:'),
            '#required' => TRUE,
            '#default_value' => $config->get('student_rollno'),
            '#options' => [1 => $this->t('1'), 2 => $this->t('2'), 3 => $this->t('3'), 4 => $this->t('4'), 5 => $this->t('5'), 6 => $this->t('6'), 7 => $this->t('7')],
        );
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Register'),
            '#button_type' => 'primary',
        );
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $this->config('student_config_form.adminsettings')
      ->set('student_name', $form_state->getValue('student_name'))
      ->set('student_rollno', $form_state->getValue('student_rollno'))
      ->save();

    parent::submitForm($form, $form_state);
  }

    
}
