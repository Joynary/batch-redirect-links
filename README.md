# batch-redirect-links
A WordPress plugin that allows batch uploading of redirect links.
If you like this, I'd love to receive your PayPal donation: @terrally1

=== Guide ===
Contributors: Joynary
Tags: elementor, navigation, widget, link manager, bookmarks
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Smart website navigation widget for Elementor with auto logo/name detection, batch import, and hover description.

== Description ==

**Guide** is a powerful and flexible Elementor widget designed to create beautiful website navigation lists and bookmark collections. It simplifies the process of adding links by automatically detecting site logos and names, and offers advanced features like batch importing and corner icons for extra functionality.

### Key Features

*   **Elementor Integration**: Seamlessly works as a native Elementor widget.
*   **Auto Detection**: Automatically fetches the website logo (favicon) and title when you enter a URL.
*   **Batch Import**: Quickly add multiple links at once using CSV or Excel files, or by pasting a list of URLs.
*   **Corner Icons**: Add up to 4 corner icons to each navigation card for secondary links (e.g., GitHub repo, documentation, external tools).
*   **Hover Effects**: Elegant hover styles that display descriptions and corner icons.
*   **Customizable**: Fully control the content, icons, and descriptions for each item.

== Installation ==

1.  Upload the `guide` folder to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  Edit a page with Elementor.
4.  Search for the "Guide Navigation" widget and drag it to your page.

== Frequently Asked Questions ==

= How do I use the Batch Import feature? =

In the Elementor editor, select the Guide widget. Under the "Content" tab, you will see a "Batch Import" section. You can upload a CSV or Excel file with the format `URL | Name | Description`, or simply paste a list of URLs to automatically fetch their details.

= Can I customize the corner icons? =

Yes! For each navigation item, you can add up to 4 corner icons. You can upload your own images, set tooltips (names), and define custom URLs for each corner icon. This is perfect for adding links to social media profiles, source code, or related resources for a specific item.

= Where does the auto-detected logo come from? =

The plugin uses the Google Favicon service to automatically retrieve the high-quality favicon for any given URL.

== Screenshots ==

1.  **Widget Interface**: The Guide widget in the Elementor editor.
2.  **Navigation Grid**: A sample navigation grid created with Guide.

== Changelog ==

= 1.0 =
*   Initial release.
*   Added Elementor widget support.
*   Implemented auto logo and title detection.
*   Added batch import functionality.
*   Added support for multiple corner icons.

