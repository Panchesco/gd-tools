<?php

/**
 * The file that defines the plugin shortcodes.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/panchesco
 * @since      1.0.0
 *
 * @package    Gd_Tools_Shortcodes
 * @subpackage Gd_Tools/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gd_Tools
 * @subpackage Gd_Tools/includes
 * @author     Richard Whitmer <richard@panchesco.com>
 */
class Gd_Tools_Shortcodes {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'GD_TOOLS_VERSION' ) ) {
			$this->version = GD_TOOLS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'gd-tools';
	}
	
	/**
   * Check active plugins for an Advanced Custom Fields plugin installation.
   * @return boolean
   */
	public function acf_active() {
  	
  	$active_plugins = get_option('active_plugins');
  	
  	foreach( $active_plugins as $plugin ) {

    	if( substr($plugin, 0, 22) == 'advanced-custom-fields' ) {
      	
      	return true;
      	
    	}
  	} 
  	
  	return false;
  	
	}
	
	
/**
 * Return a feed of posts from a shortcode.
 * @return string
 */
public static function gd_post_feed( $atts ) {
 
    $str = '';
    $path = false;
    $custom_fields = array();
   
   $a = shortcode_atts( array(
      'date_format' => get_option('date_format'),
      'post_type' => 'post',
      'category_name' => '',
      'orderby' => 'date',
      'order' => 'DESC',
      'template' => null,
      'posts_per_page' => get_option('posts_per_page'),
      'custom_fields' => ''
   ), $atts );
   
   $args['post_type'] = $a['post_type'];
   $args['category_name'] = str_replace('|','+',$a['category_name']);
   $args['orderby'] = $a['orderby'];
   $args['order'] = $a['order'];
   $args['posts_per_page'] = $a['posts_per_page'];
   
   
   // Check for Advanced Custom Fields in atts and plugins.
   if ( $a['custom_fields'] != '' ) {
     $custom_fields = explode("|",$a['custom_fields']);
    }

   $query = new WP_Query($args);
   
   if( $query->have_posts() ) {

     while( $query->have_posts() ) {

     $query->the_post();

     $the_permalink = get_the_permalink();
     $the_post_thumbnail = get_the_post_thumbnail();
     $the_post_thumbnail_url = get_the_post_thumbnail_url();
     $the_title = get_the_title();
     $the_datetime = get_the_date('c');
     $the_date = get_the_date($a['date_format']);
     $the_content = get_the_content();
     
     
     foreach( $custom_fields as $key ) {
      $$key = get_post_meta(get_the_id(), $key, true );
     }
     
     $a['template'] = '/' . trim( $a['template'], '/' );
     
     if( file_exists( get_template_directory() . $a['template'] . '.php') ) {
       echo '.php branch';
       $path = get_template_directory() . $a['template'] . '.php';
     } elseif( file_exists( get_template_directory() . $a['template'] . '.inc') ) {
       $path = get_template_directory() . $a['template'] . '.inc';
     } elseif( file_exists( $a['template'] ) ) {
       $path = $a['template'];
     } else {
       $path =  plugin_dir_path( __FILE__ )  . '../public/partials/gd_tools_post_feed-template.php'; 
     }
     
     if( $path ) {
       include( $path );
       $str.= ( isset( $template ) ) ? $template : '' ;
       }
     } 
   }
   
   wp_reset_postdata();
   
   return $str;
}

//-----------------------------------------------------------------------------



}
