<?php

//hi
namespace Drupal\custom_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_form\DateService;

class CustomFormController extends ControllerBase
{
  protected $database;
  protected $date;
  public function __construct(Connection $database, DateService $date)
  {
    $this->database = $database;
    $this->date = $date;
  }
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('database'),
      $container->get('custom_form.DateService')
    );
  }

  public function showdata()
  {


    $result = $this->database->select('address_book', 'n')
      ->fields('n', array('id', 'Name', 'Email_ID', 'Phone_No', 'DOB', 'Address'))
      ->execute()->fetchAll();
    // Create the row element.
    $rows = array();
    // $service = \Drupal::service('custom_form.DateService');
    foreach ($result as $data) {
      $rows[] = [
        'name' => $data->Name,
        'email' => $data->Email_ID,
        'phone' => $data->Phone_No,
        'date' => $this->date->datef($data->DOB),
        'address' => $data->Address,
        'delete' => t("<a href='/drupal_cms/drupal9/web/delete/$data->id'>Delete</a>"),
        'edit' => t("<a href='/drupal_cms/drupal9/web/edit/$data->id'>Edit</a>"),

      ];
    }
    // Create the header.
    $header = array('Name', 'Email_ID', 'Phone_No', 'DOB', 'Address', 'Delete', 'Edit');
    $output = array(
      '#theme' => 'table_list',    // Here you can write #type also instead of #theme.
      '#header' => $header,
      '#row' => $rows
    );
    // print_r($rows);die;
    return $output;
  }
  public function deletedata($id)
  {
    $delete = \Drupal::database()->delete('address_book')
      ->condition('id', $id, '=')
      ->execute();

    $response = new \Symfony\Component\HttpFoundation\RedirectResponse('../list-application');
    $response->send();
    \Drupal::messenger()->addMessage("fields deleted sucessfully");
  }
}
