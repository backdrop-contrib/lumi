/**
 * @file
 * Change CSS variables based on theme settings.
 */

(function($) {
  Backdrop.behaviors.lumi = {
    attach: function(context, settings) {

      var style = document.documentElement.style;
      var hsl = Backdrop.settings.lumi.colors.hsl;
      var text = Backdrop.settings.lumi.colors.text;
      var hslStart = 'hsl(' + hsl[0] + ', ' + hsl[1] + '%, ';
      var hslEnd = '%)';

      // Set CSS variables.
      style.setProperty('--color', hslStart + hsl[2] + hslEnd);
      style.setProperty('--color-alt', hslStart + lightness(hsl[2], -0.25) + hslEnd);
      style.setProperty('--color-highlight', hslStart + lightness(hsl[2], 0.9) + hslEnd);
      style.setProperty('--color-highlight-alt', hslStart + lightness(hsl[2], 0.8) + hslEnd);
      style.setProperty('--color-text', text);

    }
  };
})(jQuery);

/**
 * Change the lightness of a color by a percentage.
 *
 * 'l' is the lightness value from an HSL color (as a 0-100 integer), while
 * 'amount' is a decimal between -1 and 1 that represents the percentage to
 * change the lightness by (<0 = darken, >0 = lighten).
 */
function lightness(l, amount) {
  if (amount < 0) {
    // Darken.
    amount = Math.abs(amount);
    l = l - (l * amount);
  }
  else {
    // Lighten.
    l = l + ((100 - l) * amount);
  }

  return Math.round(l);
}
