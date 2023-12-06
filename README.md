# WordPress via Composer template

`Version: 0.6.0`

## Getting started

**Before setting this up, you should have either an Apache or Nginx webserver and a MySQL database server set up.**

- Clone/download the repo and set it up in a location of your choosing
- Copy `.env.sample` to a new file called (or rename it to) `.env`
- Populate the `.env` file with the requested information. The minimum required information is:
    - Keys & Salts (Copy & paste from [this page](https://roots.io/salts.html)):
        - `AUTH_KEY`
        - `SECURE_AUTH_KEY`
        - `LOGGED_IN_KEY`
        - `NONCE_KEY`
        - `AUTH_SALT`
        - `SECURE_AUTH_SALT`
        - `LOGGED_IN_SALT`
        - `NONCE_SALT`
    - `TRANSPORTLAYER` & `DOMAIN`
    - Database details:
        - `DB_NAME`
        - `DB_USER`
        - `DB_PASSWORD`
        - `DB_HOST`
- Run `composer install` to install all PHP packages

The WordPress website is hosted from the `/public` folder.

## What's included

This is a very minimal install. It ships with the following:

- Themes:
    - wpackagist-theme/twentytwentyfour
- Plugins:
    - wpackagist-plugin/advanced-custom-fields
    - wpackagist-plugin/redis-cache
    - humanmade/s3-uploads
    - Composer Website Quality of Life (Unique to this repo, see below)


### Composer Quality of Life

This is a small plugin that is shipped as a part of this package.

*If undesired, simply remove the files directly as it is not sourced via Composer.*

#### Features
- Disables warnings on the site health screen that aren't relevant due to Composer being used. These are removed using the `site_status_tests` hook with the following unset:
    - `theme_version`
    - `plugin_version`
    - `background_updates`
- Disables `update_nag` using the `admin_head` hook.

#### Upcoming features:
- Will enable the SMTP details provided in `.env.sample` to function.

<br>

This plugin uses the namespace `ComposerQOL` for all functions, can functions can be overidden safely.

## Features / Benefits of this approach

- Minimal install for clean project base
- Disables functionality within WordPress that can intefear with this type of deployment
- Support for Amazon S3 and Cloudflare R2 object storage via humanmade/s3-uploads plugin
- Redis object cache set up
- Allows easy control of commonly tweaked settings without the need to modify `wp-config.php`:
    - `WP_POST_REVISIONS`
    - `EMPTY_TRASH_DAYS`
    - `DISABLE_WP_CRON`


## Requirements

- PHP ^8.2
- Composer
- Apache/NGinx webserver
- MySQL server


## Todo

- SMTP functionality to be completed as the details in `.env.sample` aren't yet leveraged.
