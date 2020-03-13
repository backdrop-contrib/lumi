<?php
/**
 * @file
 * Lumi preprocess functions and theme function overrides.
 */

/**
 * Initialize theme settings.
 */
if (is_null(theme_get_setting('color', 'lumi'))) {
  // Save default theme settings.
  config_set('lumi.settings', 'color', 'purple');

  // Load default settings from the info file.
  theme_get_setting('', TRUE);
}

/**
 * Overrides template_preprocess_page().
 */
function lumi_preprocess_page(&$variables) {
  // Send theme settings to JS which will update the CSS.
  $colors = lumi_get_color(theme_get_setting('color', 'lumi'));
  backdrop_add_js(array(
    'lumi' => array(
      'colors' => $colors,
    ),
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
  switch ($name) {
    case 'blue':
      $colors['hsl'] = array(215, 45, 40);
      $colors['text'] = '#fff';
      break;
    case 'green':
      $colors['hsl'] = array(115, 35, 40);
      $colors['text'] = '#fff';
      break;
    case 'red':
      $colors['hsl'] = array(0, 60, 40);
      $colors['text'] = '#fff';
      break;
    case 'yellow':
      $colors['hsl'] = array(50, 60, 40);
      $colors['text'] = '#fff';
      break;
    default:
      // Purple.
      $colors['hsl'] = array(310, 35, 40);
      $colors['text'] = '#fff';
      break;
  }

  return $colors;
}
