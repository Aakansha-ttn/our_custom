<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "defaulttimezone",
 *  admin_label = @Translation("Defaulttimezone"),
 * )
 */
class DefaultTimezone extends BlockBase {
      
  /**
   * {@inheritdoc}
   */

public function build() {

    $req_country = \Drupal::service('country_timezone')->countryName();
    $request_time = \Drupal::service('country_timezone')->timeZone();
    
  return [
    '#theme' => 'time_zone',
   '#country' => $req_country,
   '#time' => $request_time,
    ];
   }

}