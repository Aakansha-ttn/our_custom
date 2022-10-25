<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\testmod\TimeZone;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "defaulttimezone",
 *  admin_label = @Translation("Defaulttimezone"),
 * )
 */
class DefaultTimezone extends BlockBase implements ContainerFactoryPluginInterface
{

  protected $timezone;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimeZone $time_zone)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezone = $time_zone;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('time_zone.service'),
    );
  }
  public function build()
  {

    $req_country = $this->timezone->countryName();
    $request_time = $this->timezone->timezone();

    return [
      '#theme' => 'time_zone',
      '#country' => $req_country,
      '#time' => $request_time,
    ];
  }
}
