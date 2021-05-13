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
    $link = 'Edit Post';
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
  $full_page_callout = get_field( 'full_page_callout' );
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
