<?php
/*
/*
Template Post Type: post
*/
get_header();
?>
<main id="content">
  <article id="post" <?php post_class(); ?>>
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
    <?php
    projectMenu();
    $postID = get_the_ID();
    ?>
    <?php
    $link = 'Edit Post';
    edit_post_link( $link );
    ?>
    <div class="entry-content">
      <?php
      $postType = get_field( 'post_type' );
      if ( $postType == 'blog' ):
        $author = get_author_name();
      ?>
      <p class="byline">
        <?php if($author != 'mission') { print 'By '. $author . ' on '; }  ?>
        <?php the_time('F jS, Y') ?>
        <?php // if(get_tags()){ print 'in ' . the_tags(', ');}; ?>
      </p>
      <?php  endif; ?>
      <?php if( (get_field('content_title')) || (the_content()) ): ?>
      <div class="general-content white-bg">
        <div class="container"> </div>
      </div>
      <?php endif; ?>
      <div class="entry-links">
        <?php wp_link_pages(); ?>
      </div>
    </div>
  </article>
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
