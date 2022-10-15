<?php
/**
 * @file
 * Contains \Drupal\new_form\Form\NewForm.
 */
namespace Drupal\new_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class NewForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'new_form';
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['student_name'] = array(
      '#prefix' => '<p style="color:red;">',
      '#type' => 'textfield',
      '#title' => t('Enter Name:'),
      '#required' => TRUE,
      '#attributes' => ['placeholder' => t('Enter your Name')],
      // '#prefix' => '<p id = "test">',
      '#postfix' => '</p>',
    );
    $form['student_rollno'] = array(
      '#type' => 'textfield',
      '#title' => t('Enter Enrollment Number:'),
      '#required' => TRUE,
      '#attributes' => ['placeholder' => t('Enter your roll number')],
    );
    $form['student_mail'] = array(
      '#type' => 'email',
      '#title' => t('Enter Email ID:'),
      '#required' => TRUE,
      '#attributes' => ['placeholder' => t('Enter your email id')],
      
    );
    $form['student_phone'] = array (
      '#type' => 'tel',
      '#title' => t('Enter Contact Number'),
      '#required' => TRUE,
      '#attributes' => ['placeholder' => t('Enter your phone no')],
    );
    $form['student_dob'] = array (
      '#type' => 'date',
      '#title' => t('Enter DOB:'),
      '#required' => TRUE,
      '#attributes' => ['placeholder' => t('Enter your date of birth')],
      // '#default_value' => date('Y-m-d'),
    );
  
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      // '#value' => $this->t("<a href ='http://localhost/drupal_cms/drupal9/web/listing'>Submit</a>"),
      '#button_type' => 'primary',
    );
    $form['options'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Various Options by Checkbox'),
      '#options' => array(
        'key1' => t('Option One'),
        'key2' => t('Option Two'),
        'key3' => t('Option Three'),
        'key4' => t('Option four'),
        'key5' => t('Option five'),
      ),
    
     );
     $form['positions'] = array(
      '#type' => 'radios',
      '#title' => t('Position'),
      /*'#description' => t('Select a method for deleting annotations.'),*/
      '#options' => array(1 => 'first', 2 => 'second', 3 => 'third', 4 => 'fourth'),
      '#required' => TRUE,
      // '#default_value' => 1,
      );
      $form['subjects'] = array(
        '#title' => t('subjects'),
        '#type' => 'select',
        '#description' => 'Select your favourite subject ',
        '#options' => array(1=>t('--- SELECT ---'), 2=>t('None'), 3=>t('Hindi'), 4=> t('Maths'), 5=>t('English')),
        // '#default_value' => array(3),
      );
    
    return $form;
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if(strlen($form_state->getValue('student_phone')) != 10) {
      $form_state->setErrorByName('student_phone', $this->t('Please enter a valid Contact Number'));
    }


  }
  
  public function submitForm(array & $form, FormStateInterface $form_state) {
    try{
    
      $conn = \Drupal::database();  
      $field = $form_state->getValues();
       
      $fields["student_name"] = $field['student_name'];
      $fields["student_rollno"] = $field['student_rollno'];
      $fields["student_mail"] = $field['student_mail'];
      $fields["student_phone"] = $field['student_phone'];
      $fields["student_dob"] = $field['student_dob'];
      
        $conn->insert('student_list')
           ->fields($fields)->execute();
        \Drupal::messenger()->addMessage($this->t(' Details saved'));

        $response = new \Symfony\Component\HttpFoundation\RedirectResponse('../web/listing');
        $response->send();
       
    } catch(Exception $ex){
      \Drupal::logger('new_form')->error($ex->getMessage());
    }
  
  }

}
