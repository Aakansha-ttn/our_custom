<?php

namespace Drupal\css_module\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * This is a Css Block
 * 
 * @Block(
 * id = "css_block",
 * admin_label = @Translation("Css Block"),
 * category = @Translation("Css Block"),
 * )
 */

class CssBlock extends BlockBase
{
    public function build()
    {
        return [
            '#markup' => 'hello world',
            // '#attached' => [
            //     'library' => [
            //       'css_module/custom_css',
            //     ],
            //   ],
        ];
    }
}
