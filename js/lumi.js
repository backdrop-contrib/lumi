/**
 * @file
 * Change CSS variables based on theme settings.
 */

(function($) {
  Backdrop.behaviors.lumi = {
    attach: function(context, settings) {

      var style = document.documentElement.style;
      var dark = Backdrop.settings.lumi.dark;
      var primary = Backdrop.settings.lumi.primary.hsl;
      var primaryText = Backdrop.settings.lumi.primary.text;
      var links = Backdrop.settings.lumi.links.hsl;
      var linksText = Backdrop.settings.lumi.links.text;
      var lightness = -0.3;

      // Set CSS variables.
      if (dark) {
        style.setProperty('--bg', '#222');
        style.setProperty('--bg-alt', '#333');
        style.setProperty('--border', '#444');
        style.setProperty('--text', '#fff');
        style.setProperty('--text-alt', '#888');
        style.setProperty('--grey', '#444');
        style.setProperty('--grey-alt', '#999');
        style.setProperty('--table-row', '#292929');
        style.setProperty('--table-row-hover', 'rgba(255, 255, 255, 0.08)');
        style.setProperty('--table-cell-active', 'rgba(255, 255, 255, 0.04)');
        lightness = 0.1;
      }
      style.setProperty('--primary', 'hsl(' + primary[0] + ', ' + primary[1] + '%, ' + primary[2] + '%)');
      style.setProperty('--primary-alt', 'hsl(' + primary[0] + ', ' + primary[1] + '%, ' + lighten(primary[2], lightness) + '%)');
      style.setProperty('--primary-text', primaryText);
      style.setProperty('--links', 'hsl(' + links[0] + ', ' + links[1] + '%, ' + links[2] + '%)');
      style.setProperty('--links-alt', 'hsl(' + links[0] + ', ' + links[1] + '%, ' + lighten(links[2], lightness) + '%)');
      style.setProperty('--links-text', linksText);

      $('body').addClass('lumi-js');

    }
  };
})(jQuery);

/**
 * Lighten (or darken) a color by a given percentage.
 *
 * 'color' is the lightness value from an HSL color (as a 0-100 integer), while
 * 'amount' is a decimal between -1 and 1 that represents the percentage to
 * change the lightness by (<0 = darken, >0 = lighten).
 */
function lighten(color, amount) {
  if (amount < 0) {
    // Darken.
    amount = Math.abs(amount);
    newColor = color - (color * amount);
  }
  else {
    // Lighten.
    newColor = color + ((100 - color) * amount);
  }

  return Math.round(newColor);
}
