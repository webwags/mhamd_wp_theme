
<div class="listing-block">
<div class="container">
<div class="the-column">
<?php
/*
 * search-results.php
 * This file should be created in the root of your theme directory
 */
if ( have_posts() ):
  while ( have_posts() ): the_post();
$post_type = get_post_type_object( $post->post_type );
?>
<?php
$postID = get_the_ID();
$dated = '';
if ( get_field( 'event_start_day_date' ) ) {

  $start = get_field( 'event_start_day_date' );
  $startEvent = new DateTime( $start );
  $dated = $startEvent->format( 'F jS, Y' );

} elseif ( ( get_field( 'en_publication' ) ) || ( get_field( 'es_publication' ) ) || ( get_field( 'publication_bulk_mail_form' ) ) ) {

  $dated = '';

} else {
  $dated = get_the_date();

}

?>
<div class="listing-item">
  <div class="content">
    <div class="listing-text">
      <h4><?php print $dated;?></h4>
      <h5>
        <?php the_title(); ?>
      </h5>
      <div class="dash"></div>
      <?php

      $content = get_the_content();
      $eventText = get_field( 'content_wysiwyg_copy' );
      $publicationText = get_field( 'content_copy' );

      if ( $content ) {
        $content = strip_tags( $content );
        showBeforeMore( $content );
      } elseif ( $eventText ) {
        showBeforeMore( $eventText );
      } elseif ( $publicationText ) {
        showBeforeMore( $publicationText );
      } else {}


      ?>
      <?php
      $link = 'Edit Result';
      edit_post_link( $link );
      ?>
    </div>
  </div>
  <div class="cta">
    <?php if( get_field('en_publication') || get_field('es_publication') || get_field('publication_bulk_mail_form') ): ?>
    <div>
      <?php if( get_field('en_publication') && (get_field('publication_language') == 'English')): ?>
      <a href="<?php the_field('en_publication'); ?>" target="_blank" class="download" aria-label="Download file about <?php the_title(); ?>">Download
      <div class="hidden-ada">Opens in a new window.</div>
      </a>
      <?php endif; ?>
      <?php if( get_field('es_publication') && (get_field('publication_language') == 'Spanish' )): ?>
      <a href="<?php the_field('es_publication'); ?>" target="_blank" class="download" aria-label="Download file about <?php the_title(); ?>">Download
      <div class="hidden-ada">Opens in a new window.</div>
      </a>
      <?php endif; ?>
      <?php if( get_field('publication_bulk_mail_form')): ?>
      <a href="<?php the_field('publication_bulk_mail_form'); ?>" target="_blank" class="download" aria-label="Download file about <?php the_title(); ?>">In the Mail
      <div class="hidden-ada">Opens in a new window.</div>
      </a>
      <?php endif; ?>
    </div>
    <?php else: ?>
    <a href="<?php the_permalink(); ?>"  class="download" aria-label="Read More about <?php the_title(); ?>" >Read More</a>
    <?php endif; ?>
  </div>
</div>
<?php
endwhile;

else :
  echo '<p>Sorry, no results matched your search.</p>';
endif;
wp_reset_query();
?>
