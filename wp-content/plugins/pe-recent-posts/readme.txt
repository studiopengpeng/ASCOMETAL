=== PE Recent Posts ===
Contributors: pixelemu
Donate link: https://pixelemu.com
Tags: slides, latest post, latest posts with thumbnails, recent posts, thumbnails, widget, widgets, image, images, link, links, plugin, post, posts
Requires at least: 3.4
Tested up to: 4.4.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The simple plugin that allows you to display image slides with title, description and read more linked to posts from selected category.

== Description ==
The simple plugin that allows you to display image slides with title, description and read more linked to posts from selected category. The slide title and description appear with slide-in animation effect.
The user may select the category or display items of all categories. 
Number of slides is unlimited and you may specify how many slides you want to be visible in column.
Image sizes available to select from the list are determined at Media Settings of Wordpress. This way the plugin do not have to scale images by itself which is more site optimization friendly solution. 

**Configuration (see screenshot of backend):**

1. Widget title.
2. Post type - enter post type name you want to display posts from.
3. Post type taxonomy - enter post type taxonomy name to restrict the data to display.
4. Taxonomy - select the category to taxonomy items. You may select the specified category or display items from all categories. Empty taxonomy are not displayed.
5. Force display sticky posts - applies to post type only, select if you want to include sticky post to slides.
6. Number of items in a row.
7. Number of rows.
8. Number of all items - total number of slides.
9. Creation date - show/hide post creation date, date format is taken from global settings, display date above or below title.
10. Readmore - show/hide read more link.
11. Order direction (ascending, descending).
12. Ordering type (date, title, most commented, most read).
13. Navigation (bullets, none).
14. Description limit - enetr number of chars for the each slide description.
15. Image alignment (left, right, top, bottom).
16. Show/hide thumbnail.
17. Image size from Wordpress settings (Settings > Media). 
You can choose:
thumbnail
- medium
- large
18. Grid spacing - space between items.

== Installation ==

1. Upload the 'pe-recent-posts' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to the 'Widgets' page found under the 'Appearance' menu item
4. Drag 'PE Recent Posts' to the target widget area and choose your options

== Screenshots ==
1. The backend interface.
2. Example: 2 images per row, image alinged left, no read more
3. Example: 3 thumbnails in column aligned left.
4. Example: 2 large images in column aligned at top.
5. Example: 3 images in row, no description
6. Example: no images, latest posts from selected category

== Changelog ==
= 1.0.1 =
= modified: =
* Extended possibilities for slides displaying. Now you may create a gallery grid by setting the number of slides per row.

= added: =
* Option to show/hide readmore button.
* Added "most read" value for ordering that allows to create galleries with latest posts.
* Option to show/hide navigation
* Option to show/hide thumbnails.
* Option to set a space between slides.

= 1.0.2 =
= fixed: =
* Warning appeared when fields  "Number of items in row" and "Number of rows" were cleared
* Double bootstrap scripts loading. The plugin does not load bootstrap scripts if it is already loaded by the theme.
* Cleared space of grid for last items 

= added: =
* Better adjusting images to mobile devices - counting set number of images in row and dividing its number in row on small devices. If the set number of images in row is even, images are displayed as follows, for:  991px a 768px - 2 items in row, below 768px - 1 item in row. Otherwise images are decreasing in the row adjusting to the screen resolution but below 768px images are displayed 1 item in row.
* New option enable/disable loading sticky posts.
* Added separator for every row - useful when your images have different dimensions

= 1.0.3 =
= modified: =
* Removed unnecessary Bootstrap CSS

= added: =
* Option to show/hide creation date.
* Option to choose post type and post type taxonomy
* Hide widget heading when title is empty

= fixed: =
* Improving images displaying