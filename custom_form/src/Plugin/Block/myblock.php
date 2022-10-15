<?php

namespace Drupal\custom_form\Plugin\Block;

use Symfony\Component\DependencyInjection\ContainerInterface;
use \Drupal\Core\Url;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\Core\Config\Entity\Query\QueryFactory;
use Drupal\Core\Database\Connection;


use Drupal\Core\Block\BlockBase;
// use Drupal\user\Plugin\views\argument_default\CurrentUser;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "my_block",
 *   admin_label = @Translation("My block"),
 *   category = @Translation("My block"),
 * )
 */
class myblock extends BlockBase implements ContainerFactoryPluginInterface
{
    protected $database;

    public function __construct( array $configuration, $plugin_id, $plugin_definition, Connection $database)
    {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->database = $database;
    }

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database'),
    );
  }
  

    /**
     * {@inheritdoc}
     */
    public function build()
    {

    $row = [];
    $options = ['absolute' => TRUE];

    $query = $this->database->select('node_field_data', 'nfd')
      ->fields('nfd', ['nid', 'type', 'status', 'title', 'changed', 'uid']);
      $query->addField('ufd', 'name');
      $query->join('users_field_data', 'ufd', 'ufd.uid = nfd.uid');

    $executed = $query->execute();
    $results = $executed->fetchAll();

    foreach ($results as $n) {
      $nodeurl = Url::fromRoute('entity.node.canonical', ['node' => $n->nid], $options);
      $nodeurl = $nodeurl->toString();
      $userurl = Url::fromRoute('entity.user.canonical', ['user' => $n->uid], $options);
      $userurl = $userurl->toString();

      $row[] = [
        'title' => $this->t("<a href='$nodeurl'> $n->title</a>"),
        'type' => $n->type,
        // 'author' => $this->t("<a href='$userurl'>$n->uid</a>"), 
        'author' => $this->t("<a href='$userurl'>$n->name</a>"),
        'status' => $n->status?'published':'unpublished',
        'update' => date('m/d/Y', $n->changed),
      ];
    

        }

        $header = ['TITLE', 'CONTENT TYPE', 'AUTHOR', 'STATUS', 'UPDATED'];
        return [
            '#theme' => 'content_show',
            '#header' => $header,
            '#rows' => $row,

        ];
    }
}
