=== RSS No More ===
Contributors: jneuveglise
Donate link: http://my2cents.info/rss-no-more/
Tags: rss, cut, more, footer, rss footer, truncate
Requires at least: 2.8
Tested up to: 3.0
Stable tag: 1.5

This plugin will cut your RSS feeds at the 'more' tag or custom [rss-cut] tag and optionally append a footer to each article on your RSS feed.

== Description ==

This plugin will cut your RSS feeds at the "more" tag. It will enable you subscriber to see what you want them to see as on the home of your blog. 

It will also add a customizable link at the bottom to the complete article and optionally a fully configurable footer to avoid robots to steal your content.

It will not work if you choose 'partial' feeds in the WP configuration.


== Installation ==


1. Upload the `rss-no-more/` folder to your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. And voilà !

== Frequently Asked Questions ==

= What is text to prepend to each article ? =

When you truncate your feed with this plugin, a link is added on relevant posts (those with a 'more' tag in them). With this option you can choose what text to add before the post title. 
IE the link can look like 'Continue reading The Super Article' where 'The Super Article' is your blog post title.

= What is the footer ? =

If you wish you can add a dynamic footer to each article in your RSS feed. For example you might add credentials to avoid bots to steal your work without any backlink.

= What dynamic fields can I use in the footer ? =

You can use specific keywords such as:

*  %%POSTLINK%% for the post link with title as anchor
*  %%BLOGLINK%% for your blog url with blog title as anchor
*  %%BLOGDESCLINK%% for your blog url with blog title and description as anchor
*  %%AUTHOR%% for the post author's name

== Screenshots ==


== Changelog ==

= 1.5 =
* Added the [rss-cut] tag to enable you to choose where to cut on an article basis. You can also switch off the automatic cut at the more tag.

= 1.1 = 
* Bug fix thanks to Isidro

= 1.0 =
* Small bux fix in variable init.
* Added 3.0 compatibility

= 0.5 =
* Added tracking data to the footer links as well

= 0.4 =
* Added an option to track clicks from the 'more' link in the feed (using utm_source, utm_campaign, utm_medium)

= 0.3 =
* Added an option to emphasis the 'more' link created in your feed (italic)
* Added an option to style the RSS Footer (using your own CSS attibutes)

= 0.2.4 =
* Bug fix when feed were not cut on some installations

= 0.2.3 =
* Bug fix (strip slashes - again ! - in the 'more' link)

= 0.2.2 =
* Bug fix (to avoid author's name to be printed first in the feed)

= 0.2.1 =
* Minor bug fix (strip slashes in the footer)
* Added fr_FR translation
* Added an option to remove plugin settings from the database

= 0.2 =
* Added configuration pannel
* Added RSS footer option

= 0.1 =
* Initial Release 

