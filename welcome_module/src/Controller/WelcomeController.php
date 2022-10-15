<?php

namespace Drupal\welcome_module\Controller;

/**
 *
 */
class WelcomeController {

  /**
   *
   */
  public function welcome() {
    $var = ['name' => 'aakansha'];
    return [
      '#theme' => 'mytheme',
      '#data' => $var,

    ];
  }

  /**
   *
   */
  public function hello() {
    return [
      '#markup' => 'Welcome to my first hello.',
    ];
  }

}
