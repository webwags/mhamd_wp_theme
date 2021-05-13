<?php
/**
 * What to do with single POSTS
 *
 * @package mhamd
 */


while ( have_posts() ): the_post();

$post_type = get_post_type();
//print_r($post_type);

switch ( $post_type ) {

  case 'landing_page':
    get_template_part( 'templates/single-landing', 'page' );
    break;
  case 'grid_page':
    get_template_part( 'templates/single-grid', 'page' );
    break;
  case 'filter_page':
    get_template_part( 'templates/single-filter', 'page' );
    break;
  case 'list_page':
    get_template_part( 'templates/single-list', 'page' );
    break;
  case 'event':
    get_template_part( 'templates/single-event', 'page' );
    break;
  case 'resource':
    get_template_part( 'templates/single-resource', 'page' );
    break;
  case 'publication':
    get_template_part( 'templates/single-publication', 'page' );
    break;
  case 'callout':
    get_template_part( 'templates/single-callout', 'block' );
    break;
  case 'custom_page':
    get_template_part( 'templates/single-custom', 'page' );
    break;
  case 'search':
    get_template_part( 'search', 'page' );
    break;
  case 'post':
    get_template_part( 'post' );
    break;
  default:
    get_template_part( 'page' );
    break;

};

endwhile;