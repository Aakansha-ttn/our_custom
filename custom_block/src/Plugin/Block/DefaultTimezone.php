<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_block\CountryTime;

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

  protected $countryTime;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, CountryTime $country_time)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->countryTime = $country_time;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('country_timezone'),
    );
  }
  public function build()
  {

    $req_country = $this->countryTime->countryName();
    $request_time = $this->countryTime->timeZone();

    return [
      '#theme' => 'time_zone',
      '#country' => $req_country,
      '#time' => $request_time,
    ];
  }
}
