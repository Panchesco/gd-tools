<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the post feed shortcode.
 *
 * @link       https://github.com/panchesco
 * @since      1.0.0
 *
 * @package    Godat_Tools
 * @subpackage Godat_Tools/public/partials
 */
?>

<?php 
$template = <<<EOT
<!-- Add post feed shortcode HTML and variables beteen these comments.  -->   

<article>
  <time datetime="$the_datetime">$the_date</time>
  <h2><a href="$the_permalink">$the_title</a></h2>
  <h3>$custom_field</h3>
  <p>$the_excerpt</p>
</article>
<!-- END -->      
EOT;
