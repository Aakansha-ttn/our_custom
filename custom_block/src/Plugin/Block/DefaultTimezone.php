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

    $system_date = \Drupal::config('system.date')->get('country.default');
    $request_time = \Drupal::time()->getCurrentTime();
    
  return [
    '#markup' => 'default time zone',
    
    ];
   }

}