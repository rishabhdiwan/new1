<?php
 
/*
 
Plugin Name: Rishabh's First 
 
Plugin URI: https://rdd.com/
 
Description: A custom POstype PLugun.
 
Version: 1.0
 
Author: Rishabh 
 
Author URI: https://drr.com/
 
License: GPLv2 or later
 
Text Domain: tutsplus
 
*/


/*Custom Post type start*/

function rishabh_news() {

    $supports = array(
    'title', // post title
    'editor', // post content
    'author', // post author
    'thumbnail', // featured images
    'custom-fields', // custom fields
    'comments', // post comments
    );
    
    $labels = array(
    'name' => _x('news', 'plural'),
    'singular_name' => _x('news', 'singular'),
    'menu_name' => _x('news', 'admin menu'),
    'name_admin_bar' => _x('news', 'admin bar'),
    'add_new' => _x('Add New', 'add new'),
    'add_new_item' => __('Add New news'),
    'new_item' => __('New news'),
    'edit_item' => __('Edit news'),
    'view_item' => __('View news'),
    'all_items' => __('All news'),
    'search_items' => __('Search news'),
    'not_found' => __('No news found.'),
    );
    
    $args = array(
    'supports' => $supports,
    'labels' => $labels,
    'public' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'news'),
    'has_archive' => true,
    'hierarchical' => false,
    );
    register_post_type('news', $args);
    }
    add_action('init', 'rishabh_news');
    
    /*Custom Post type end*/

    /* Custom Status for a Post*/ 
// Register Custom Post Status
function my_status_creation(){
    register_post_status( 'INWriting', array(
    'label'                     => _x( 'INWriting', 'news' ),
    'label_count'               => _n_noop( 'INWriting <span class="count">(%s)</span>', 'INWriting <span
    class="count">(%s)</span>'),
    'public'                    => true,
    'exclude_from_search'       => false,
    'show_in_admin_all_list'    => true,
    'show_in_admin_status_list' => true
    ));
    }
    add_action( 'init', 'my_status_creation' );
    function add_post_status_dropdown()
    {
    global $post;
    if($post->post_type != 'news')
    return false;
    $status = ($post->post_status == 'INWriting') ? "jQuery( '#post-status-display' ).text( 'INWriting' ); jQuery(
    'select[name=\"post_status\"]' ).val('INWriting');" : '';
    echo "<script>
    jQuery(document).ready( function() {
    jQuery( 'select[name=\"post_status\"]' ).append( '<option value=\"INWriting\">INWriting</option>' );
    ".$status."
    });
    </script>";
    }
    // add_action( 'post_submitbox_misc_actions', 'add_post_status_dropdown');
    // function custom_status_add_in_quick_edit() {
    //     global $post;
    //     if($post->post_type != 'news')
    //     return false;
    //     echo "<script>
    //     jQuery(document).ready( function() {
    //     jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"INWriting\">INWriting</option>' );
    //     });
    //     </script>";
    //     }
    //     add_action('admin_footer-edit.php','custom_status_add_in_quick_edit');
    // function display_archive_state( $states ) {
    //     global $post;
    //     $arg = get_query_var( 'post_status' );
    //     if($arg != 'INWriting'){
    //     if($post->post_status == 'INWriting'){
    //     echo "<script>
    //     jQuery(document).ready( function() {
    //     jQuery( '#post-status-display' ).text( 'INWriting' );
    //     });
    //     </script>";
    //     return array('INWriting');
    //     }
    //     }
    //     return $states;
    //     }
    //     add_filter( 'display_post_states', 'display_archive_state' );