<?php
/**
 * @file
 * Lumi theme settings.
 */

$colors = array(
  'blue' => t('Blue'),
  'indigo' => t('Indigo'),
  'purple' => t('Purple'),
  'pink' => t('Pink'),
  'red' => t('Red'),
  'orange' => t('Orange'),
  'yellow' => t('Yellow'),
  'green' => t('Green'),
  'teal' => t('Teal'),
  'cyan' => t('Cyan'),
);

$form['dark'] = array(
  '#type' => 'checkbox',
  '#title' => t('Dark mode'),
  '#default_value' => theme_get_setting('dark', 'lumi'),
);
$form['primary'] = array(
  '#type' => 'select',
  '#title' => t('Primary color'),
  '#description' => t('The primary color is used for elements such as the site header and form buttons.'),
  '#options' => $colors,
  '#default_value' => theme_get_setting('primary', 'lumi'),
);
$form['links'] = array(
  '#type' => 'select',
  '#title' => t('Link color'),
  '#options' => $colors,
  '#default_value' => theme_get_setting('links', 'lumi'),
);
