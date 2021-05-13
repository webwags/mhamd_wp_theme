<?php
/**
 * Get Category, filtered by the taxonomy term, if one was selected.
 *
 * @return WP_Query Filter in the taxonomy term if one was selected, else all.
 */
function grid_filtered_by_taxonomy_term() {
  return new WP_Query( array(
    'post_type' => 'publicaton', // Change this to the slug of your post type.
    'posts_per_page' => 500, // Display a maximum of 500 options in the dropdown.
    'tax_query' => grid_filtered_by_taxonomy_term_tax_query(),
  ) );
}
/**
 * Get the taxonomy query to be used by grid_filtered_by_taxonomy_term().
 *
 * @return array The taxonomy query if a term was selected, else an empty array.
 */
function grid_filtered_by_taxonomy_term_tax_query() {
  $selected_term = grid_filtered_selected_taxonomy_dropdown_term();
  // If a term has been selected, use that in the taxonomy query.
  if ( $selected_term ) {
    return array(
      array(
        'taxonomy' => 'publicaton', // Change this to the slug of your taxonomy.
        'field' => 'term_id',
        'terms' => $selected_term,
      ),
    );
  }
  // Otherwise, don't filter based on a taxonomy term and just get all the results.
  return array();
}
/**
 * Get the selected taxonomy dropdown term slug.
 *
 * @return string The selected taxonomy dropdown term ID, else empty string.
 */
function grid_filtered_selected_taxonomy_dropdown_term() {
  return isset( $_GET[ 'items' ] ) && $_GET[ 'items' ] ? sanitize_text_field( $_GET[ 'items' ] ) : '';
}