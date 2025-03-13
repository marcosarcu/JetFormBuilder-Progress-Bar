=== JetForm Progress Bar ===
Contributors: marcosarcu
Tags: jetform, form builder, progress bar, multi-step forms
Requires at least: 5.0
Tested up to: 6.7.2
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a customizable progress bar to JetFormBuilder multi-step forms.

== Description ==

JetForm Progress Bar is a WordPress plugin that adds a customizable progress bar to JetFormBuilder multi-step forms. It helps users track their progress through multi-step forms with a visual indicator.

= Features =

* Customizable progress bar colors
* Adjustable height
* Smooth transitions
* Easy to implement with shortcode
* Fully responsive

= Requirements =

* JetFormBuilder plugin installed and activated
* WordPress 5.0 or higher
* PHP 7.4 or higher

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/jetform-progress-bar` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the shortcode `[jfb_progress_bar id="your-form-id"]` to display the progress bar in your form.

== Frequently Asked Questions ==

= How do I use the progress bar? =

Add the shortcode `[jfb_progress_bar id="your-form-id"]` to your form. Replace "your-form-id" with the actual ID of your JetFormBuilder form.

= Can I customize the appearance? =

Yes, you can customize the progress bar using the following attributes:
* color: The color of the progress bar (default: #4caf50)
* background: The background color (default: #f3f3f3)
* height: The height of the progress bar (default: 20px)

Example: `[jfb_progress_bar id="123" color="#ff0000" background="#ffffff" height="30px"]`

== Screenshots ==

1. Progress bar in action
2. Customization options
3. Shortcode implementation

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release of JetForm Progress Bar. 