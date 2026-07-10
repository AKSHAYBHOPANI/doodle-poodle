/**
 * Doodle Poodle - Customizer live preview.
 */
(function ($) {
	'use strict';

	wp.customize('blogname', function (value) {
		value.bind(function (to) { $('.dp-logo, .site-title').text(to); });
	});

	function bindColor(setting, cssVar) {
		wp.customize(setting, function (value) {
			value.bind(function (to) {
				document.documentElement.style.setProperty(cssVar, to);
			});
		});
	}
	bindColor('dp_color_primary', '--dp-primary');
	bindColor('dp_color_secondary', '--dp-secondary');
	bindColor('dp_color_accent', '--dp-accent');

	wp.customize('dp_hero_title', function (value) {
		value.bind(function (to) { $('.dp-hero__title').html(to); });
	});
	wp.customize('dp_hero_text', function (value) {
		value.bind(function (to) { $('.dp-hero__text').text(to); });
	});
	wp.customize('dp_hero_eyebrow', function (value) {
		value.bind(function (to) { $('.dp-hero__eyebrow').text(to); });
	});
})(jQuery);
