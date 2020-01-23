=== Aurora ===

Contributors: 			sailorgoodway
Requires at least: 		WordPress 5.0
Tested up to: 			WordPress 5.0.3
Stable tag: 			5.0.0
Version: 				5.0.0
Requires PHP:			5.2
License: 				GPLv2 or later
License URI:			http://www.gnu.org/licenses/gpl-2.0.html
Donate Link:			No donations required, a honest wordpress.org review would be appreciated.
Tags: 					one-column, two-columns, left-sidebar, right-sidebar, accessibility-ready, custom-background, custom-header, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, full-width-template, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks, blog

A starter theme based on Underscores. No child theme is required to use the theme, simply give the theme a new name and away you go. This theme is meant for developers although it does not require much development experience. Aurora is in fact a great learning tool. This theme plays nicely with the Block Editor as well as the Classic Editor. It provides a quick and easy way of building a fully responsive and accessibility-ready theme without much effort.

== Copyright ==

1. Aurora WordPress Theme, Copyright 2019 Drew Macy
Aurora is distributed under the terms of the GNU GPL

2. Aurora is based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc.
Underscores is distributed under the terms of the GNU GPL v2 or later.

3. The theme bundles the following third-party resources:

	3.1. normalize.css, Copyright 2012-2016 Nicolas Gallagher and Jonathan Neal License: MIT Source: https://necolas.github.io/normalize.css/

	3.2. FitVids 1.1, Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com, Released under the WTFPL license - http://sam.zoy.org/wtfpl/

	3.3. In the customizer a custom text radio button control is used. The author of this custom control is Anthony Hortin, https://maddisondesigns.com, licensed under the GNU General Public License v2 or later.

== Theme Features ==

I have been using Underscores from the day it was first released. As a developer Underscores has saved me many hours of work. I did find that because I was using the same starter theme again and again that I was continually adding the same code to the starter theme. Obviously this meant that Underscores needed a bit more code to serve my purposes. This theme was intended as a new starter theme based on Underscores which I could use for my own purposes.

* The theme is a single or two-column theme. All the features of the Block Editor work in both single or two column mode except for the wide and full alignments, these only work in the single column mode or if the full-width page/post templates are being used.

* A full-width page template as well as post template has been added for when the two-column option has been selected but certain pages and posts still need to be single-column.

* The theme plays very nicely with the Block Editor as well as the Classic Editor.

* Both the Block Editor as well as the Classic Editor has the same look and feel as the theme. What you see on the back-end is similar to what you will see on the front-end.

* The theme contains quite a bit more code and styling than Underscores but it is not bloated. It still is a starter theme without the frills like custom actions and hooks. The code is simple to undertand and it is well commented. The theme is not intended to be used as a parent theme.

* A full SASS template to make changing fonts and  colours a lot easier has been included. The SASS template has been setup to match the table of contents in the stylesheet. This makes finding the correct .scss files a lot easier.

* The theme is fully responsive as well as being accessibility-ready.

* All code meets the all the requirements of the Theme Check and Theme Sniffer plugins.

* The standard WordPress functionality e.g. custom background, custom header, custom menu, custom logo, sticky post, threaded comments and featured images have all been included in the theme.

* There are 6 widget areas (main sidebar, 3 footer widgets and 2 single page widgets).

* There are basic customizer options included sporting a custom text radio button control. The customizer options can easily be extended.

* The theme has 2 menu positions (primary and footer menus).

* Full RTL-language-support has been included.

* The theme is translation-ready.

* The FitVids script has been included to aid responsiveness.

== Using The Theme ==

* Decide on a name for the theme you want to build.

* Create a directory under your /wp-content/themes/ directory. Give this directory the same name as your intended domain name.

* Copy Aurora in its entirety to this new directory.

* In your code editor do a search and replace in all files for the words 'aurora' and 'aurora' with your new name (take note the use of capital and lowercase characters).

* There is one file included in this theme that you will have to rename manually, /inc/class-aurora-text-radio-button-control.php. Change the Aurora portion of this file name to your new theme name.

* Activate your new theme in your WordPress installation.

* Setup your preferred options in the customizer.

* Setup the widgets you require.

* Setup the menus you are going to need.

* Open /sass/0.variables/_options.scss and set the options you require.

* You now have a fully responsive and accessibility-ready theme all you have to do now is to keep things that way.

* You can now customize any of the coding or styling without the fear that any later release of Aurora will overwrite your hard work.

* Enjoy your theme and it is hoped you build something spectacular.

== Customization ==

Peruse the following templates to find out exactly what is happening where:

* /sass/0.variables/_options.scss and _mixins.scss - you will need to know what is going on here to be able to use the SASS templates.

* /inc/template-functions.php and template-tags.php - this will give you some idea of the custom functions that have been added to Aurora.

* You will notice that the directory structure of the SASS template follows the same naming conventions as the table of contents in the stylesheet. This makes finding the correct SASS file easier when changing the styling.

* Support is also offered via the WordPress forums or my website (https://arnoldgoodway.com). 

== Frequently Asked Questions ==

= Which plugins does the theme support? =

The theme does not require any specific plugins to run. The theme has been run alongside most of the plugins that most blogs use constantly and no problems were experienced. A few styling changes have been included in the theme to match JetPack's contact form with the theme.

= Is support offered? =

The normal support via the WordPress forums is available. You can also visit my blog for articles on customising the theme. As I notice that many people are asking the same questions on the forum I will write a tutorial on my blog to cover the issue. (https://arnoldgoodway.com)

= Can I use a child theme? =

I suppose you could but then you would lose the SASS functionality. You could overcome this by copying the SASS template to your child theme.

= I do not want to use SASS =

You could delete the entire SASS template should you so wish and then make all your styling changes directly in the stylesheet. You could now find yourself having to make multiple changes where you could have just changed one SASS option.

== Theme Limitations ==

* There are no fallbacks for the two menu positions. If you do not implicitly add a specific menu no menu will appear.

* When adding menus please keep responsiveness in mind. Do not go overboard with the number of first level menu items. In the case of the primary menu you can add as many sub-items as you require but keep the top level as small as possible.

* The footer menu is a single-level flat menu and therefore the number of menu items is even more critical.

* No support for post-formats has been included.

* Support has been added for the block editor's wide-align and full-align. These alignments will however only work if no sidebar is being shown or the full-width page/post templates are being used,

* The theme has only been tested in the latest versions of Chrome, Safari, Opera, Firefox Edge and Internet Explorer 11.

* The custom header image is not shown as a link to the home page, this was done for accessibility reasons (a link here adds duplicate adjacent links).

* Responsiveness has been tested on all the browser simulators but the only real mobile device it has been tested on is a Samsung Android phone running the latest Chrome.

== Upgrade Notice ==

* This section could be required in new themes built with Aurora.

== Changelog ==

= 5.0.0 =
* Initial release
