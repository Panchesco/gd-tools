# Good Tools 

Starter plugin for quickly prototyping features for our Wordpress projects.

## Description 

This plugin is for quickly prototyping features we want to develop for WP projects. 
The framework got its start with the  [Wordpress Plugin Boilerplate Genertator](https://wppb.me/)


## Installation 

1. Upload `godat-tools.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Short Codes

### ```[gd_post_feed]``` 

Displays a feed of recent posts, each wrapped in a specified partial.

#### Parameters

| Parameter | Required | Default | Options |
| --- | --- | --- | --- |
| post_type | No | post | post, page, custom-post-type-slug |
| orderby | No | date | title,date |
| order | No | desc | desc, asc |
| posts_per_page | No | current posts per page option | integer |
| category_name | No | pipe-delimited list of category slugs |
| custom_fields | No | pipe-delimited list of custom field names (requires [Advanced Custom Fields](https://www.advancedcustomfields.com) plugin) |
| template | No | theme-dir/filename full path to partial to render shortcode |

#### Example 

```
[gd_post_feed post_type="news" category_name="national|local" custom_fields="byline|profile" template="inc/news-card"]

```
