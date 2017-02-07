# RSS Proxy Link Formatter Module

## Introduction

The RSS Proxy Link Formatter module provides both a link field formatter and a RSS feed proxy and JSON conversion service. This allows you to add a link field to a content type to store a URL to a rss feed and a title for the feed. The link field formatter will take that RSS link and display it on the page using an AJAX call. The AJAX call will proxy it through the provided proxy service which retrieves the RSS feed contents and return them as JSON. Optionally you can limit the number of results shown in the field formatter settings.

The purpose of this module was to allow for cross origin requests of RSS feeds by AJAX calls. Sites that make heavy use of external caches link varnish and other caching mechanisms would not be able to update the feed solely in the PHP templates.

## Requirements

* Drupal 7
* [Link Module](https://www.drupal.org/project/link)

## Installation

After downloading the module in the modules folder, visit the Modules (/admin/modules) page to enable the module. You might have to install the required modules before enabling this module.

## Configuration

1. Enable the module
2. visit /admin/config/services/rss-proxy-link-formatter to configure the module.
3. Add link field to a content type to hold the URL to the RSS feed you want to display.
4. Link fields will have a new formatter called *AJAX Proxy of RSS Link*.
5. Optionally configure the maximum results to display in the formatter settings.
