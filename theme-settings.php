<?php
/**
 * @file
 * Lumi theme settings.
 */

$form['color'] = array(
  '#type' => 'radios',
  '#title' => t('Color scheme'),
  '#options' => array(
    'purple' => t('Purple'),
    'blue' => t('Blue'),
    'green' => t('Green'),
    'red' => t('Red'),
    'yellow' => t('Yellow'),
  ),
  '#default_value' => theme_get_setting('color', 'lumi'),
);
