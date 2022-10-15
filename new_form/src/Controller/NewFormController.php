<?php


namespace Drupal\new_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NewFormController extends ControllerBase
{

  protected $database;
  public function __construct(Connection $database) {
    $this->database=$database;
}
public static function create(ContainerInterface $container) {
  return new static(
      $container->get('database')
  );
}

  public function showdata()
  {

 
    $result = $this->database->select('student_list', 'n')
      ->fields('n', array('id', 'student_name', 'student_rollno', 'student_mail', 'student_phone', 'student_dob'))
      ->execute()->fetchAll();
    // Create the row element.
    $rows = array();
    foreach ($result as $data) {
      $rows[] = [
        'name'=> $data->student_name,
         'rollno' => $data->student_rollno, 
         'email' => $data->student_mail, 
         'phone' => $data->student_phone, 
         'date' => $data->student_dob,
        'delete' => t("<a href='/drupal_cms/drupal9/web/delete-row/$data->id'>Delete</a>"),
        'edit' => t("<a href='/drupal_cms/drupal9/web/edit-form/$data->id'>Edit</a>"),
    
];
    }
    // Create the header.
    $header = array('Name', 'ROLL NO', 'EMAIL', 'PHONE NO', 'DOB', 'DELETE', 'EDIT');
    $output = array(
      '#type' => 'table',    
      '#header' => $header,
      '#rows' => $rows
    );
    return $output;
  } 
  public function deletedata($id){
    $delete=\Drupal::database()->delete('student_list')
            ->condition('id',$id,'=')
            ->execute();

            $response = new \Symfony\Component\HttpFoundation\RedirectResponse('../listing');
            $response->send();
            \Drupal::messenger()->addMessage("fields deleted sucessfully");
            

}
}