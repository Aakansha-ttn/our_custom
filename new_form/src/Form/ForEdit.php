<?php

/**
 * @file
 * Contains \Drupal\new_form\Form\NewForm.
 */

namespace Drupal\new_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ForEdit extends FormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'edit_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $id = \Drupal::routeMatch()->getParameter('id');
        $db = \Drupal::database();
        $data = $db->select('student_list', 't')
            ->fields('t', ['student_name',  'student_rollno', 'student_mail', 'student_phone', 'student_dob'])
            ->condition('t.id', $id, '=')
            ->execute()->fetchAll(\PDO::FETCH_OBJ);

        $form['student_name'] = array(
            '#type' => 'textfield',
            '#title' => t('Enter Name:'),
            '#required' => TRUE,
            '#default_value' => $data[0]->student_name,
        );
        $form['student_rollno'] = array(
            '#type' => 'textfield',
            '#title' => t('Enter Enrollment Number:'),
            '#required' => TRUE,
            '#default_value' => $data[0]->student_rollno,
        );
        $form['student_mail'] = array(
            '#type' => 'email',
            '#title' => t('Enter Email ID:'),
            '#required' => TRUE,
            '#default_value' => $data[0]->student_mail,

        );
        $form['student_phone'] = array(
            '#type' => 'tel',
            '#title' => t('Enter Contact Number'),
            '#required' => TRUE,
            '#default_value' => $data[0]->student_phone,
        );
        $form['student_dob'] = array(
            '#type' => 'date',
            '#title' => t('Enter DOB:'),
            '#required' => TRUE,
            '#default_value' => $data[0]->student_dob,
        );

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
            '#button_type' => 'primary',
        );
        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        if (strlen($form_state->getValue('student_phone')) != 10) {
            $form_state->setErrorByName('student_phone', $this->t('Please enter a valid Contact Number'));
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {

        $id = \Drupal::routeMatch()->getParameter('id');

        $db = \Drupal::database();

        $query = $db->update('student_list')

            ->fields(
                [
                    'student_name' => $form_state->getValue('student_name'),
                    'student_rollno' => $form_state->getValue('student_rollno'),
                    'student_mail' => $form_state->getValue('student_mail'),
                    'student_phone' => $form_state->getValue('student_phone'),
                    'student_dob' => $form_state->getValue('student_dob'),
                ]
            )

            ->condition('id', $id)
            ->execute();
        $response = new \Symfony\Component\HttpFoundation\RedirectResponse('../listing');
        $response->send();

        \Drupal::messenger()->addMessage("fields update sucessfully");
    }
}
