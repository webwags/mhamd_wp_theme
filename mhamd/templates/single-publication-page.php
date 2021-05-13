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
$link = 'Edit Publication';
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
<div class="angled-base-bkg">
  <div class="listing-block angled-base">
    <div class="container">
      <div class="three-column">
        <div class="listing-item">
          <?php $publication_image = get_field('publication_image'); ?>
          <div class="listing-img"><img src="<?php print $publication_image[url]; ?>" alt="<?php print $publication_image[alt]; ?>"></div>
          <div class="content">
            <div class="listing-text">
              <h5>
                <?php the_title(); ?>
              </h5>
            </div>
          </div>
          <div class="cta">
            <?php if( get_field('en_publication') || get_field('es_publication')): ?>
            <div>
              <h5 class="dload">Download</h5>
              <?php if( get_field('en_publication')): ?>
              <a href="<?php the_field('en_publication'); ?>" target="_blank" class="download" >English </a>
              <?php endif; ?>
              <?php if( get_field('es_publication')): ?>
              <a href="<?php the_field('es_publication'); ?>" target="_blank" class="download" >Spanish </a>
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if( get_field('publication_bulk_mail_form')): ?>
            <div> <a   href="<?php the_field('publication_bulk_mail_form'); ?>" target="_blank" class="download" >In the Mail</a></div>
            <?php endif; ?>
          </div>
        </div>
        <div class="entry-links">
          <?php wp_link_pages(); ?>
        </div>
      </div>
    </div>
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
