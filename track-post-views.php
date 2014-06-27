<?php
/*
Plugin Name: Track Post Views
Plugin URI: https://github.com/adde/track-post-views
Description: Tracks and saves the number of post views as a post meta field.
Version: 0.0.1
Author: Andreas Jönsson
Author URI: http://consid.se
*/



$tpv_config = array(

  'post_count_key' => 'post_views_count'

);



/**
 * Register post views
 *
 */
function tpv_set_post_views( $postID ) {
  global $tpv_config;
  $count_key = $tpv_config['post_count_key'];
  $count = get_post_meta( $postID, $count_key, true );
  if( $count=='' ){
    $count = 0;
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
  } else{
    $count++;
    update_post_meta( $postID, $count_key, $count );
  }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );



/**
 * Track views in wp_head() function
 *
 */
function tpv_track_post_views( $postID ) {
  if ( !is_single() && !is_page() ) return;
  if ( empty ( $postID) ) {
    global $post;
    $postID = $post->ID;
  }
  tpv_set_post_views( $postID );
}
add_action( 'wp_head', 'tpv_track_post_views' );



/**
 * Get number of views by post ID
 *
 */
function tpv_get_post_views( $postID ){
  global $tpv_config;
  $count_key = $tpv_config['post_count_key'];
  $count = get_post_meta( $postID, $count_key, true );
  if( $count == '' ){
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
    return 0;
  }
  return $count;
}



/**
 * Get the post meta field key
 *
 */
function tpv_get_key()
{
  global $tpv_config;
  return $tpv_config['post_count_key'];
}