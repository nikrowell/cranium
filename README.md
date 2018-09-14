# Cranium

> A brainless WordPress theme for modern frontends. Inspired by Express.

As frontends started becoming more dynamic and detached from the backends that powered them, headless CMS services like [Prismic](https://prismic.io/) and [Contentful](https://www.contentful.com/) started gaining popularity. Those services are fantastic, but I wanted to continue using a familiar, open source and self-hosted solution.

## Installation

1. Download the latest version of WordPress<br>`curl -O https://wordpress.org/latest.zip`

2. Unzip the file you just downloaded<br>
`unzip latest.zip`

3. Copy the unzipped files into the parent directory<br>
`cp -r wordpress/ ./` OSX<br>
`cp -RT wordpress/ ./` Linux

4. Remove the zip<br>
`rm latest.zip`

5. Remove the unzipped folder<br>
`rm -fr wordpress/`

6. Edit wp-config.php as needed, including [security salts](https://api.wordpress.org/secret-key/1.1/salt/) and default DB credentials. For added security, new installs should set `$table_prefix` to something other than 'wp_'

## Configuration

Cranium uses a modified wp-config.php file that allows for setting environment-specific core and theme constants. If a **wp-config-local.php** file exists, it will be imported after the default settings have loaded. All core and theme constants are set using an associate array, where keys become PHP constants:

```
$env['WP_DEBUG'] = true;
$env['DB_HOST'] = 'localhost';
$env['MY_CONSTANT'] = 808;
```

Production settings sould be set in wp-config.php and overriden as needed in wp-config-local.php, which is part of the default gitignore. If sensitive information needs to be kept out of repositories (API keys etc), a wp-config-local.php file can also be used in a production environment.

## Usage

More examples coming soon!
Using Cranium as theme vs a separate API etc...

```php
require 'app/autoload.php';

$app->get('/work/@slug:[a-zA-Z0-9-]+', function($req, $res) {

    $slug = $req->param('slug');
    $page = get_page_by_path($slug);

    if ($page === null) {
        $res->status(404)->send(['error' => 'Not Found']);
    }

    $res->json([
        'id' => $page->ID,
        'url' => get_permalink($page),
        'slug' => $page->post_name,
        'title' => get_the_title($page),
        'content' => apply_filters('the_content', $page->post_content)
    ]);
});
```

## API

### Application
### Request
### Response
### Cache

## Files

Method of organizing files that works wells for most WordPress projects.<br>
The advantage to this is always knowing where to look or where to add a new hook if needed.<br>
More info coming soon...

## Gotchas

Links from post content or `get_permalink()` calls when using Cranium as a standalone api.

```php
// functions/filters.php
function replace_home_url($str) {
    return str_replace(home_url(), '', $str);
}

add_filter('page_link', 'replace_home_url');
add_filter('post_link', 'replace_home_url');
add_filter('the_content', 'replace_home_url');
```

## Questions

### Why not just use the official REST API?
Good question. Cranium removes the "brains" of WordPress by hijacking all requests via the [do_parse_request](https://developer.wordpress.org/reference/hooks/do_parse_request/) filter. This means that nothing will load and that all request parsing and responses are up to you. Unless interecepted by a custom route handler, Cranium will load the theme's **index.php** file. This file could be empty (for example, using Cranium at `api.example.com`), or could contain your bundled assets and any bootstrapped data you want to pass along. Here are some goals:

* Potential speed increase, avoiding uneccessary queries.
* Simplified interface for defining custom routes.
* Customized, lighter weight responses. If your front-end is expecting `id`, `title` and `content`, you can easily omit many properties like `post_mime_type` and `post_modified_gmt`.
* Less verbose. Ever wonder why people loath working with WordPress but love frameworks like Laravel and Lumen?
```php
// how does this make you feel?
add_action('rest_api_init', function() {
    register_rest_route('my-namespace', '/hello/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => function($req) {
            return new WP_REST_Response(['slug' => $req->get_param('slug')]);
        }
    ]);
});

// compared to this?
$app->get('/hello/@slug:[a-zA-Z0-9-]+', function($req, $res) {
    $res->json(['slug' => $req->param('slug')]);
});
```

### Why not a plugin?
The whole point is to not be a theme and to approach WordPress differently. In fact, many plugins won't work as expected given how Craniun hijacks request parsing and leaves all responses and redering up to you.

### Why not use WordPress without a theme?
WP_USE_THEMES is a handy constant indeed, but by using WordPress as a standalone platform, you loose access to many useful lifecycle hooks, including [ACF](https://www.advancedcustomfields.com/resources/) filters, admin actions etc.

### Why is your screenshot.png so lame?
I don't know.