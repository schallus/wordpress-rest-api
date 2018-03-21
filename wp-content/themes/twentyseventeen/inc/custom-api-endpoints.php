<?php
/**
 * Grab latest post by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post for the latest,  * or null if none.
 */
function my_awesome_func( $data ) {
  $posts = get_posts( array(
    'author' => $data['id'],
  ) );
 
  if ( empty( $posts ) ) {
    return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 422 ) );
  }
 
  return $posts[0];
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'custom/v1', '/author/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
  ) );
} );