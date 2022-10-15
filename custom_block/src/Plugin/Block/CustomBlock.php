<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "customblock",
 *  admin_label = @Translation("CustomBlock"),
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface {
  
  /**
   * * @var AccountInterface $account
   */
  protected $account;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $account) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
    );
  }
  
  /**
   * {@inheritdoc}
   */

public function build() {
    $username = $this->account->getAccountName();
    $email =  $this->account->getEmail();

  //  return array('#markup'=> $this->account->getAccountName() . '<br>' . $this->account->getEmail());
  return [
   '#theme' => 'custom_login',
   '#name' => $username,
   '#email' => $email,
    // '#data' => $data,
    
    ];
   }

}