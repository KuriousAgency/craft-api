# Craft API plugin for Craft CMS 3.x

An basic api for craft.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1.  Open your terminal and go to your Craft project:

        cd /path/to/project

2.  Then tell Composer to load the plugin:

        composer require kuriousagency/craft-api

3.  In the Control Panel, go to Settings → Plugins and click the “Install” button for Craft API.

## Craft API Overview

-Insert text here-

## Configuring Craft API

If you want to restrict access to the api, set a token in the plugin settings and then pass that token as the Bearer token in the the Authorization header.

## Using Craft API

create an \_api root folder in your template location.
Then any sub folders will match the route path of the api url: eg. /api/news => \_api/news/index.twig
If the last segment is number then that will gets passed to the matching previous template as the id variable

## Craft API Roadmap

Some things to do, and ideas for potential features:

-   Release it

Brought to you by [Kurious Agency](https://kurious.agency)
