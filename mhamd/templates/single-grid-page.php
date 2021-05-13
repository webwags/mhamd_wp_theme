<?php
/*
Template Name: Grid Page
Template Post Type: page
*/
get_header();
?>
<main id="content">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="header">
      <div class="featured static" style="background-image: url(<?php the_field('background_image'); ?>)">
        <div class="container">
          <div class="content">
            <h1 class="entry-title">
              <?php the_title(); ?>
            </h1>
            <?php if( get_field('subtitle')): ?>
            <h3>
              <?php the_field('subtitle'); ?>
            </h3>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php projectMenu(); ?>
    <?php
    $link = 'Edit Grid Page';
    edit_post_link( $link );
    ?>
    <div class="entry-content">
      <?php if( (get_field('content_title')) || (get_field('content_copy')) ): ?>
      <div class="general-content white-bg">
        <div class="container">
          <?php if( get_field('content_title')): ?>
          <div class="headline centered">
            <div class="dash"></div>
            <h2>
              <?php the_field('content_title'); ?>
            </h2>
            <div class="dash"></div>
          </div>
          <?php endif; ?>
          <?php the_field('content_copy'); ?>
          <?php if(get_field('list_of_publicaitons')): ?>
          <a target="_blank" href="<?php print get_field('list_of_publicaitons');?>" class="btn border purple">Download Publication List</a>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
      <div class="entry-links">
        <?php wp_link_pages(); ?>
      </div>
    </div>
  </article>
  <?php
  //print the_field('list_page_type') . ' <br>';
  $cat_id = get_field( 'list_category_type' );
  $ctTermID = get_field( 'list_page_type' );
  $ctTerm = get_term( $ctTermID, 'content_type' );
  $grid_type = $ctTerm->slug;
  $ctTerm = 'content_type_' . $ctTermID;
  $content_type_template = get_field( 'content_type_template', $ctTerm );
  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $today = current_time( 'Ymd' );


  $args = array(
    'cat' => array( $cat_id ),
    'post_status' => array( 'publish' ),
    'nopaging' => false,
    'posts_per_page' => 9,
    'paged' => $paged,

  );

  if ( $grid_type == 'event' ) {
    $args += array(
      'post_type' => 'event',
      'orderby' => 'event_start_day_date',
      'order' => 'ASC',
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key' => 'event_start_day_date',
          'value' => $today,
          'compare' => '>=',
        ),
        array(
          'key' => 'event_end_day_date',
          'value' => $today,
          'compare' => '>=',
        ),
      ),
    );
  } elseif ( $grid_type == 'publication' ) {
    $args += array(
      'orderby' => 'title',
      'order' => 'ASC',
      'post_type' => 'publication'

    );

  } elseif ( $grid_type == 'post' ) {
    $args += array(
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'post'
    );

  } else {
    $args += array(
      'orderby' => 'title',
      'order' => 'ASC',
      'post_type' => $grid_type
    );
  }
  $wpex_query = new WP_Query( $args );
  global $wpex_query;
  ?>
  <?php  getGridTemplate ($grid_type); ?>
  <?php wp_reset_postdata(); // reset the query ?>
  <?php wpex_pagination(); ?>
  <?php wp_reset_postdata(); // reset the query ?>
  <?php
  $full_page_callout = get_field( 'full_page_callouts' );
  if ( $full_page_callout ) {
    $postID = $full_page_callout[ 'full_page_callout' ];
    $term_obj_full = get_the_terms( $postID, 'callout_type' );
    $callout_type = join( ', ', wp_list_pluck( $term_obj_full, 'slug' ) );
  }
  ?>
  <?php getCalloutTemplate( $callout_type); ?>
</main>
<?php
get_sidebar();
get_footer();
?>
