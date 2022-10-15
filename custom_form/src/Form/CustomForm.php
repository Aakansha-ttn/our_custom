<?php
namespace Drupal\custom_form\Form;
 
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
 
/**
 * Provides the form for Details.
 */
class CustomForm extends FormBase {
 
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form';
  }
 
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
 
 
    $form['Name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#required' => TRUE,
    );
    $form['Email'] = array(
      '#type' => 'email',
      '#title' => t('Email ID'),

    );
    $form['Phone_No'] = array(
      '#type' => 'tel',
      '#title' => t('Phone No'),
    );
    $form['DOB'] = array(
      '#type' => 'date',
      '#title' => t('DOB'),
    );
    $form['Address'] = array(
      '#type' => 'textarea',
      '#title' => t('Address'),
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

    $form['options'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Various Options by Checkbox'),
      '#options' => array(
        'key1' => t('Option One'),
        'key2' => t('Option Two'),
        'key3' => t('Option Three'),
      ),
      // '#default_value' => variable_get( 'options', array('key1', 'key3') ),
     );

    
 
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
  public function submitForm(array & $form, FormStateInterface $form_state) {
	try{
		$conn = Database::getConnection();
		
		$field = $form_state->getValues();
	   
		$fields["Name"] = $field['Name'];
		$fields["Email_ID"] = $field['Email'];
		$fields["Phone_No"] = $field['Phone_No'];
		$fields["DOB"] = $field['DOB'];
		$fields["Address"] = $field['Address'];
		  $conn->insert('address_book')
			   ->fields($fields)->execute();
		  \Drupal::messenger()->addMessage($this->t(' Details saved'));
		 
	} catch(Exception $ex){
		\Drupal::logger('custom_form')->error($ex->getMessage());
	}
  
  }
 
}