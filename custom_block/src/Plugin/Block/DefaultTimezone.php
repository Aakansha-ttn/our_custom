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
    $request_time = date('d-m-Y h:i:s a',\Drupal::time()->getCurrentTime());
    
  return [
    '#markup' => $system_date.'<br>'.$request_time,
    
    ];
   }

}