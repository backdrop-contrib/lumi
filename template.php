<?php
/**
 * @file
 * Lumi preprocess functions and theme function overrides.
 */

/**
 * Overrides template_preprocess_page().
 */
function lumi_preprocess_page(&$variables) {
  // Get theme settings.
  $settings['primary'] = lumi_get_color(theme_get_setting('primary', 'lumi'));
  $settings['links'] = lumi_get_color(theme_get_setting('links', 'lumi'));

  // Send theme settings to JS (so it can update the CSS).
  backdrop_add_js(array(
    'lumi' => $settings,
  ), 'setting');
}

/**
 * Convert Lumi colour names to their colour values.
 *
 * @param string $name
 *   The name of the colour to convert, as defined in theme-settings.php.
 *
 * @return array
 *   An associative array that contains:
 *   - hsl: An array with integer values matching the hue, saturation and
 *     lightness of the colour (respectively). The hue range is 0-360, while the
 *     saturation and lightness ranges are 0-100 (they represent percentages but
 *     don't include the '%' symbol).
 *   - text: The colour to use for text displayed on a coloured background
 *     (generally white or black).
 */
function lumi_get_color($name) {
  $color = array();

  switch ($name) {
    case 'blue':
      $color['hsl'] = array(210, 29, 24);
      $color['text'] = '#fff';
      break;
    case 'indigo':
      $color['hsl'] = array(263, 90, 51);
      $color['text'] = '#fff';
      break;
    case 'purple':
      $color['hsl'] = array(261, 51, 51);
      $color['text'] = '#fff';
      break;
    case 'pink':
      $color['hsl'] = array(332, 79, 58);
      $color['text'] = '#fff';
      break;
    case 'red':
      $color['hsl'] = array(6, 78, 57);
      $color['text'] = '#fff';
      break;
    case 'orange':
      $color['hsl'] = array(27, 98, 54);
      $color['text'] = '#000';
      break;
    case 'yellow':
      $color['hsl'] = array(37, 90, 51);
      $color['text'] = '#000';
      break;
    case 'green':
      $color['hsl'] = array(168, 77, 42);
      $color['text'] = '#fff';
      break;
    case 'teal':
      $color['hsl'] = array(162, 73, 46);
      $color['text'] = '#000';
      break;
    case 'cyan':
      $color['hsl'] = array(204, 70, 53);
      $color['text'] = '#fff';
      break;
  }

  return $color;
}

/**
 * Overrides theme_tablesort_indicator().
 */
function lumi_tablesort_indicator($variables) {
  // Remove the default tablesort icons.
  return FALSE;
}

/**
 * Implements hook_preprocess_HOOK() for theme_table.
 */
function lumi_preprocess_table(&$variables) {
  // Add header classes for sorting.
  $ts = tablesort_init($variables['header']);
  foreach ($variables['header'] as $delta => $value) {
    if (is_array($value) && isset($value['field'])) {
      $variables['header'][$delta]['class'][] = 'sortable';

      if ($value['data'] == $ts['name']) {
        $variables['header'][$delta]['class'][] = 'sort-' . $ts['sort'];
      }
    }
  }
}

/**
 * Implements hook_preprocess_HOOK() for theme_views_view_table.
 */
function lumi_preprocess_views_view_table(&$variables) {
  // Add header classes for sorting.
  foreach ($variables['header'] as $field => $value) {
    if (strpos($value, '<a ') !== FALSE) {
      $variables['header_classes'][$field][] = 'sortable';

      if (in_array('active', $variables['header_classes'][$field])) {
        $dir = (strpos($value, 'sort=asc') !== FALSE) ? 'desc' : 'asc';
        $variables['header_classes'][$field][] = 'sort-' . $dir;
      }
    }
  }
}

/**
 * Overrides theme_textfield().
 *
 * Add an empty span after the input element to hold the autocomplete icon.
 */
function lumi_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength', 'placeholder'));
  _form_set_class($element, array('form-text'));

  $extra = '';
  if ($element['#autocomplete_path'] && !empty($element['#autocomplete_input'])) {
    backdrop_add_library('system', 'backdrop.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#autocomplete_input']['#id'];
    $attributes['value'] = $element['#autocomplete_input']['#url_value'];
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<span class="autocomplete-icon"></span><input' . backdrop_attributes($attributes) . ' />';
  }

  $output = '<input' . backdrop_attributes($element['#attributes']) . ' />';

  return $output . $extra;
}
