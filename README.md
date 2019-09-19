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
| custom_fields | No | pipe-delimited list of custom field names |
| template | No | /wp-content/plugins/gd-tools/public/partials/gd_tools_post_feed-template.php | any full full path to a .php partial | 

#### Variables

* $the_title
* $the_permalink
* $the_post_thumbnail
* $the_post_thumbnail_url
* $the_datetime
* $the_date
* $custom_field

#### Examples

##### Shortcode
```
[gd_post_feed post_type="news" category_name="national|local" custom_fields="byline|profile" template="inc/news-card"]

```

##### Template 

The template for rendering the shortcode should define a single string variable ```$template``` containing the HTML and post variables.

```
$template = '
  <div class="card">
    <a href="' . $the_permalink . '"><img data-original="' . $the_post_thumbnail_url . '" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="card-img-top lazyload" alt=""></a>
    <div class="card-body">
      <div class="title-time">
        <h6><a href="' . $the_permalink . '">' . $the_title  . '</a></h6> 
        <time datetime="' . $the_datetime . '">' . $the_date . '</time>
      </div>
    <h5 class="card-title"><a href="' . $the_permalink . '">' . $the_title . '</a></h5>';
  $template.= '</div>
  <a class="overlay" href="' . $the_permalink . '"></a>
</div>
';
```
