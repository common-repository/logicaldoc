=== LogicalDOC WordPress Explorer ===
Contributors: shakilodem
Donate link: https://www.logicaldoc.com/
Tags: logicaldoc, document management, system, software, integration, tool, dms
Requires at least: 4.8.6
Tested up to: 5.9.2
Requires PHP: 7.4
Stable tag: 1.0.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

LogicalDOC WordPress Explorer realizes the integration between LogicalDOC DMS and WordPress

== Description ==

LogicalDOC is a document management software that is designed to handle and share documents within an organization. This plugin allows you to expose in a controlled way a portion of the document repository in WordPress, allowing folder browsing, document downloading and full-text search. 

Features:
* Ability to connect to whatever local or remote LogicalDOC instance
* Display LogicalDOC's document table in Posts or Pages
* Browse the content of folders with breadcrumb facility
* Sort by different metadata
* Perform full-text searches
* Download documents
* Ability to password protect access to a specific resource
* Option to expose a restricted section of the document repository starting from a specific node (Folder ID)
* Customizable columns set
* Possibility of real-time filter the contents of a folder or a search


== Installation ==

1. This plugin requires that the PHP option short_open_tag be enabled (On)
2. This plugin requires the SOAP module for PHP
3. Upload the plugin files to the `/wp-content/plugins/logicaldoc` directory, or install the plugin through the WordPress plugins screen directly.
4. Activate the plugin through the 'Plugins' screen in WordPress
5. Click on the new menu item "LogicalDOC" and create your first LogicalDOC's connection setting!
6. Now you can embed the LogicalDOC view in your post or in a page simply by placing the referral to the configuration eg. [logicalDoc id="37"] 


== Frequently Asked Questions ==

= This plugin works with LogicalDOC Community Edition? =

Yes, the plugin works with both LogicalDOC Community Edition (free) than with commercial editions of LogicalDOC

= Which version of LogicalDOC is compatible with this plugin? =

The plugin has been tested and developed with LogicalDOC 7.7.5 and is compatible with LD 8.4

= Secure HTTPS works? =

Yes
                                                                                      

== Screenshots ==

1. Creating a new configuration (connection to LogicalDOC)

2. Listing configurations

3. Embed the configuration in a Page

4. Page display on the frontend 

5. Advanced Search form and results (frontend)


== Changelog ==

= 1.0.10 =
* Fixed HTML duplicate ID errors
* Tested up to WordPress version 5.9.2
* Tested with LogicalDOC version 8.7.3
* Compatible with PHP 7.4.15

= 1.0.9 =
* Adapted the graphics for the theme TwentyTwenty v1.5
* Fixed error during document download (upgraded jquery.validationEngine to version 2.6.5)
* Tested up to WordPress version 5.5
* Tested with LogicalDOC version 8.5
* Compatible with PHP 7.2.24

= 1.0.8 =
* Fixed a header issue when Wordpress runs on Windows webserver IIS
* Tested up to WordPress version 5.3.2
* Tested with LogicalDOC version 8.4
* Compatible with PHP 7.2.24

= 1.0.7 =
* Tested up to WordPress version 5.2.1
* Tested with LogicalDOC version 8.3
* Compatible with PHP 7.1.29
* Upgraded requirements (this plugin requires SOAP module for PHP)
* Added new sortable column Type to the list table and Search filter
* Works best with the Twenty Seventeen and Twenty Sixteen themes (from the visual point of view)

= 1.0.6 =
* Tested up to WordPress version 4.9.5
* Tested with LogicalDOC version 7.7.5
* Upgraded requirements (this plugin requires SOAP module for PHP)
* Added new sortable column Type to the list table and Search filter

= 1.0.3 =
* Sanitized GET calls
* Fixed issue of lost sessions on the server caused by download requests

= 1.0.2 =
* Generic function (and/or define) names - fixed #02

= 1.0.1 =
* Generic function (and/or define) names - fixed
* Allowing Direct File Access to plugin files - fixed 
* Including jquery files (or calling them remotely) - fixed

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
Nothing to do, this is the initial release


