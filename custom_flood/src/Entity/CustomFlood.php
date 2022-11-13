<?php

namespace Drupal\custom_flood\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Custom Flood entity.
 *
 * @ingroup customFlood
 *
 * @ContentEntityType(
 *   id = "custom_flood",
 *   label = @Translation("Custom Flood"),
 *   base_table = "custom_flood",
 *   entity_keys = {
 *     "identifier" = "identifier",
 *     "status" = "status",
 *     "event" = "event",
 *     "timestamp" = "timestamp",
 *     "expiration" = "expiration",
 *   },
 * )
 */

class CustomFlood extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields['identifier'] = BaseFieldDefinition::create('string')
      ->setLabel(t('IDENTIFIER'))
      ->setDescription(t('The IDENTIFIER of the Custom Flood entity.'))
      ->setReadOnly(TRUE);

    $fields['status'] = BaseFieldDefinition::create('string')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Custom Flood entity.'))
      ->setReadOnly(TRUE);

    $fields['event'] = BaseFieldDefinition::create('string')
      ->setLabel(t('EVENT'))
      ->setDescription(t('The event of the flood table'))
      ->setReadOnly(TRUE);

    $fields['timestamp'] = BaseFieldDefinition::create('timestamp')
    ->setLabel(t('TIMPSTAMP'))
    ->setDescription(t('The time stamp of the flood table'))
    ->setReadOnly(TRUE);

    $fields['expiration'] = BaseFieldDefinition::create('timestamp')
    ->setLabel(t('EXPIRATION'))
    ->setDescription(t('The expiration of the flood table'))
    ->setReadOnly(TRUE);

    return $fields;
  }
}