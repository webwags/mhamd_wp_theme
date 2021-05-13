<?php
/*
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
    $link = 'Edit Callout Block';
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
        </div>
      </div>
      <?php endif; ?>
      <div class="entry-links">
        <?php wp_link_pages(); ?>
      </div>
    </div>
  </article>
  <?php
  $choose_callouts_type = get_field( 'choose_callouts_type' );
  $mixType = $choose_callouts_type[ 'callout_type' ];
  if ( $mixType == 1 ) {
    $mixTypeFull = $choose_callouts_type[ 'mix_full_page_callouts' ];
    $postID = $mixTypeFull[ 'mix_full_page_callout' ];
    $term_obj_full = get_the_terms( $postID, 'callout_type' );
    $callout_type = join( ', ', wp_list_pluck( $term_obj_full, 'slug' ) );
    getCalloutTemplate( $callout_type );
  } elseif ( $mixType == 2 ) {
    $mixTypeHalf = $choose_callouts_type[ 'mix_half_page_callouts' ];
    $postID_left = $mixTypeHalf[ 'mix_left_callout' ];
    $postID_right = $mixTypeHalf[ 'mix_right_callout' ];
    $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
    $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
    $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
    $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
    print '<div class="btm-module-50-50">';
    print '<div class="module left">';
    getCalloutTemplate( $callout_left_type );
    print '</div>';
    print '<div class="module right">';
    getCalloutTemplate( $callout_right_type );
    print '</div>';
    print '</div>';

  }
  ?>
</main>
<?php
get_sidebar();
get_footer();
?>
