<?php
/**
 * @file
 * Contains \Drupal\custom_form\Form\Form.
 */
namespace Drupal\custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EditForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'edit_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $id=\Drupal::routeMatch()->getParameter('id');
    $db= \Drupal::database();
    $data = $db->select('address_book', 't')
    ->fields('t', ['Name',  'Email_ID', 'Phone_No', 'DOB', 'Address'])
    ->condition('t.id',$id,'=')
    ->execute()->fetchAll(\PDO::FETCH_OBJ);
    // print_r($data);die;

    
      $form['Name'] = array(
        '#type' => 'textfield',
        '#title' => t('Name'),
        '#required' => TRUE,
        '#default_value' => $data[0]->Name,
      );
      $form['Email'] = array(
        '#type' => 'email',
        '#title' => t('Email ID'),
        '#default_value' => $data[0]->Email_ID,
  
      );
      $form['Phone_No'] = array(
        '#type' => 'tel',
        '#title' => t('Phone No'),
        '#default_value' => $data[0]->Phone_No,
      );
      $form['DOB'] = array(
        '#type' => 'date',
        '#title' => t('DOB'),
        '#default_value' => $data[0]->DOB,
      );
      $form['Address'] = array(
        '#type' => 'textarea',
        '#title' => t('Address'),
        '#default_value' => $data[0]->Address,
      );
      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#button_type' => 'primary',
        '#default_value' => $this->t('Submit') ,
      ];
  
      $form['reset'] = array(
        '#type' => 'button',
        '#button_type' => 'reset',
        '#value' => t('reset'),
        '#validate' => array(),
        '#attributes' => array(
          'onclick' => 'this.form.reset(); return false;',),
      );
      // print_r($form)
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {

    if (strlen($form_state->getValue('Phone_No')) < 10) {
      $form_state->setErrorByName('Phone_No', $this->t('Please enter a valid Phone Number'));
    }
  }
 
  
  /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
       /* \Drupal::messenger()->addMessage($this->t("Details Submitted successfully!! Submitted Values are:"));
         foreach ($form_state->getValues() as $key => $value) {
        \Drupal::messenger()->addMessage($key . ': ' . $value);
        } */
        // $renderdata = [
        //   'Name' => $form_state->getValue('Name'),
        //   'Email' => $form_state->getValue('Email'),
        //   'Phone_No' => $form_state->getValue('Phone_No'),
        //   'DOB' => $form_state->getValue('DOB'),
        //   'Address' => $form_state->getValue('Address'),
        // ];
        $id = \Drupal::routeMatch()->getParameter('id');

        $db = \Drupal::database();

        $query = $db->update('address_book')
        
            ->fields(
                [
                    // 'Name' => $renderdata('Name'),
                    // 'Email_ID' => $renderdata('Email'),
                    // 'Phone_No' => $renderdata('Phone_No'),
                    // 'DOB' => $renderdata('DOB'),
                    // 'Address' => $renderdata('Address'),
                    'Name' => $form_state->getValue('Name'),
                    'Email_ID' => $form_state->getValue('Email'),
                    'Phone_No' => $form_state->getValue('Phone_No'),
                    'DOB' => $form_state->getValue('DOB'),
                    'Address' => $form_state->getValue('Address'),
                ]
            )
          
            ->condition('id',$id)
            ->execute();
            $response = new \Symfony\Component\HttpFoundation\RedirectResponse('../list-application');
            $response->send();

              \Drupal::messenger()->addMessage("fields update sucessfully");
    }

}
