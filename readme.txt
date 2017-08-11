=== Paste Analytics ===
Contributors: Jens Törnell
Tags: google, analytics, google analytics, ga, statistics, stats, tracking
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Paste your Google Analytics script in wp-admin to track your site.

== Description ==

Google Analytics, clean and simple!

Features:

* Paste your script and save. Done!
* The tracking code is disabled for logged in users
* You can set the script to be active or inactive

== Installation ==

1. Upload `paste-analytics.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to `Settings > Paste Analytics` to paste your Google Analytics script

== Frequently Asked Questions ==

= Does this plugin have tons of features? =

No. Paste the script and save. Done!

= Can I do advanced tracking stuff with this plugin? =

Probably. You have the freedom to write whatever you need in the script.

= Can block IP numbers from being tracked? =

Yes and no. Not by this plugin, but you can do it with Google Analytics own settings.

= Does the tracking work when I'm logged in? =

No. It's disabled when logged in. Just a HTML comment remains in the code.

= Can I disable tracking on certain pages/post? =

Maybe. You can not do it with this plugin but it might be possible in Google Analytics, or by disable an action on that page.

= Why not just use an advanced Google Analytics plugin =

 * Advanced plugins often have tons of options. Still they might not have everything. With this plugin you can write the script as you like.
 * This plugin is very simple. Set it and forget it. Paste the script and save. Done!
 * This plugin only use one option field which makes it very fast.

= Why not use a before / after-plugin?

They are ment for all kinds of scripts / CSS / HTML. It also means more settings that you don't need.

= The tracking code does not appear? =

If you are not logged in and still no tracking code are visible in the source you might be missing the `wp_head` action in header.php (or another file)

= Can I have the tracking code in the footer or direcly after the <body>-tag?

No. Not at present. If `wp_head` is not in the theme it will try to use `wp_footer` instead.

== Screenshots ==

1. `Settings > Paste Analytics`

== Changelog ==

= 1.1 =
* Fixed some minor bugs

= 1.0 =
* Initial release