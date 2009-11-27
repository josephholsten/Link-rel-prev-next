<?php
/*
Plugin Name: Link Adjacent Pages
Plugin URI: http://blog.josephholsten.com/
Description: Adds a links in the head of the page for each of the adjacent pages if the user has it installed. These allow browsers like Opera to automatically go to the next or previous page.
Version: 0.1.0
Author: Joseph Holsten
Author URI: http://josephholsten.com
*/

function link_rel_prev_next() {
	// <link rel="home" title="Home" href="http://url/of/home/page" />
	$prev_url = '';
	$next_url = '';
	if (!is_singular()) {
		$prev_url = get_previous_posts_page_link();
		$next_url = get_next_posts_page_link();
		
		if ( !empty( $prev_url ) ) { 
		  printf( '<link rel="prev" href="%s" />' . "\n", $prev_url ); 
		}
		if ( !empty( $next_url ) ) { 
		  printf( '<link rel="next" href="%s" />' . "\n", $next_url ); 
		}
	} else {
		global $post;
		
		// $up_post = get_post($post->post_parent);
		// 
		// $prev_post = get_previous_post();
		// if ( !empty( $prev_post->ID))
		//   printf( '<link rel="prev" title="%s" href="%s" />' . "\n", $prev_post->post_title , get_permalink($prev_post->ID) );
		// 
		// $next_post = get_next_post();
		// if ( !empty($next_post->ID))
		//   printf( '<link rel="next" title="%s" href="%s" />' . "\n", $prev_post->post_title , get_permalink($next_post->ID) );

		safe_link_rel('next', get_post($post->parent));
		safe_link_rel('prev', get_previous_post());
		safe_link_rel('next', get_next_post());
		
	}
}

function safe_link_rel($rel, $post) {
	if (!empty($post->ID))
	  printf( '<link rel="%s" title="%s" href="%s" />' . "\n", $rel, $post->post_title , get_permalink($post->ID) );
}

add_action( 'wp_head', 'link_rel_prev_next' );
?>