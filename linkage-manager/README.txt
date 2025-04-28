=== Linkage Manager ===
Contributors: samuelmarcello
Tags: linkage, partners, affiliates, directory
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to create and manage Linkages with custom fields and shortcodes.

== Description ==

Linkage Manager allows you to create and manage a list of Linkages on your WordPress site. Each Linkage can have a name, logo, description, and category (Private or Public).

= Features =

* Create and manage Linkages using a custom post type
* Add custom fields for Logo, Description, and Category
* Display Linkages using shortcodes
* Filter Linkages by Category
* Responsive grid and list layouts
* Translation-ready

= Shortcodes =

**Linkage List**

Display a list of all Linkages:

`[linkage_list]`

Optional parameters:
* `category` - Filter by category (public or private)
* `layout` - Display layout (grid or list, default: grid)
* `columns` - Number of columns for grid layout (default: 3)
* `details_page` - URL of the details page (default: current page)

Example with parameters:
`[linkage_list category="public" layout="grid" columns="4" details_page="https://example.com/linkage-details"]`

**Linkage Detail**

Display a single Linkage based on the URL parameter:

`[linkage_detail]`

Optional parameters:
* `not_found_message` - Custom message to display when no linkage is found

Example with parameters:
`[linkage_detail not_found_message="Sorry, the requested linkage could not be found."]`

== Installation ==

1. Upload the `linkage-manager` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create Linkages from the 'Linkages' menu in the WordPress admin
4. Use the shortcodes to display Linkages on your site

== Usage ==

= Creating a Linkage =

1. Go to Linkages > Add New in the WordPress admin
2. Enter a name for the Linkage
3. Add a description in the content editor
4. Set a featured image as the Linkage logo
5. Select a category (Private or Public) from the Linkage Category meta box
6. Publish the Linkage

= Displaying Linkages =

1. Create a page for the Linkage list
2. Add the `[linkage_list]` shortcode to the page
3. Create a page for Linkage details
4. Add the `[linkage_detail]` shortcode to the details page
5. Set the `details_page` parameter in the list shortcode to point to your details page

== Frequently Asked Questions ==

= Can I customize the appearance of Linkages? =

Yes, the plugin provides CSS classes for easy styling. You can add custom CSS to your theme to override the default styles.

= Can I add more fields to Linkages? =

Yes, you can extend the plugin by adding more meta boxes or using a plugin like Advanced Custom Fields.

== Changelog ==

= 1.0.0 =
* Initial release
