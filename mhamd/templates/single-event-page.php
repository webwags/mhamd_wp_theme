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
<?php projectMenu(); ?>
<?php
$link = 'Edit Event';
edit_post_link( $link );
?>
<div class="entry-content">
  <div class="general-content white-bg">
    <div class="container">
      <?php if( (get_field('content_title')) || (get_field('content_copy')) ): ?>
      <?php if( get_field('content_title')): ?>
      <div class="headline centered">
        <div class="dash"></div>
        <h2>
          <?php the_field('content_title'); ?>
        </h2>
        <div class="dash"></div>
      </div>
      <?php endif; ?>
      <?php the_field('content_wysiwyg_copy'); ?>
      <?php endif; ?>
      <?php
      $event_location = get_field( 'event_location_group' );
      $pub_category_name = $pub_category_object[ 0 ]->name;
      $pub_category_name = $pub_category_object[ 0 ]->name;
      $eventType = get_field( 'event_type' );
      $start = get_field( 'event_start_day_date' );
      $startEvent = new DateTime( $start );
      $startDay = $startEvent->format( 'l, M jS, Y' );
      $end = get_field( 'event_end_day_date' );
      $endEvent = new DateTime( $end );
      $endDay = $endEvent->format( 'l, M jS, Y' );
      $startDayStartTime = get_field( 'event_start_day_start_time' );
      $startDayEndTime = get_field( 'event_start_day_end_time' );
      $endDayStartTime = get_field( 'event_end_day_start_time' );
      $endDayEndTime = get_field( 'event_end_day_end_time' );
      $eventDayConjunct = get_field( 'event_day_conjunct' );
      $event = '';


      if ( $end != '' ) {
        if ( ( ( $startDayStartTime == $endDayStartTime ) && ( $startDayEndTime == $endDayEndTime ) ) || ( ( $endDayStartTime == '' ) || ( $endDayEndTime == '' ) ) ) {
          $event = '<h4>Dates:</h4><p> ' . $startDay . ' ' . $eventDayConjunct . ' ' . $endDay . '  ' . $startDayStartTime . ' - ' . $startDayEndTime . '</p> ';
        } else {
          $event = '<h4>Dates:</h4><p> ' . $startDay . ' ' . $startDayStartTime . ' - ' . $startDayEndTime . ' ' . $eventDayConjunct . ' ' . $endDay . ' ' . $endDayStartTime . ' - ' . $endDayEndTime . '</p> ';
        };
      } else {
        $event = '<h4>Date:</h4><p> ' . $startDay . ' </p> <h4>Time:</h4> <p> ' . $startDayStartTime . ' - ' . $startDayEndTime . '</p> ';
      }
      ?>
      <?php if( $event != '' ): ?>
      <div><?php print $event; ?></div>
      <?php endif; ?>
      <?php if(  $event_location ): ?>
      <div>
        <h4>Location:</h4>
        <p>
          <?php if( $event_location['event_location']): ?>
          <?php print $event_location['event_location']; ?><br/>
          <?php endif; ?>
          <?php if(  $event_location['event_street_address'] ): ?>
          <?php print $event_location['event_street_address']; ?><br/>
          <?php endif; ?>
          <?php if(  $event_location['event_street_address_continued'] ): ?>
          <?php print $event_location['event_street_address_continued']; ?><br/>
          <?php endif; ?>
          <?php if(  $event_location['event_city'] ): ?>
          <?php print $event_location['event_city']; ?>,
          <?php endif; ?>
          <?php if( $event_location['event_state']): ?>
          <?php print $event_location['event_state']; ?>
          <?php endif; ?>
          <?php if( $event_location['event_zip'] ): ?>
          <?php print $event_location['event_zip']; ?><br/>
          <?php endif; ?>
        </p>
      </div>
      <?php endif; ?>
      <?php if( get_field('event_form_url')): ?>
      <div>
        <p><a class="btn border purple" href="<?php the_field('event_form_url'); ?>">Register for the Event</a></p>
      </div>
      <?php endif; ?>
    </div>
  </div>
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
