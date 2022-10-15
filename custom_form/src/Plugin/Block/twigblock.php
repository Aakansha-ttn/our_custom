<?php

namespace Drupal\custom_form\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "my_block_example_block",
 *   admin_label = @Translation("twig block"),
 * )
 */
class twigblock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $str="hello akansha";
    return [
      '#theme' => 'show_variable',
      '#var' => 50,
    ];
  }
}