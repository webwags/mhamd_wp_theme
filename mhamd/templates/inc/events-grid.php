<?php
global $wpex_query;
?>
<div class="angled-base-bkg">
  <div class="listing-block  angled-base">
    <div class="container">
      <div class="three-column">
        <?php
        while ( $wpex_query->have_posts() ): $wpex_query->the_post();
        $pub_post_id = get_the_ID(); // or use the post id if you already have it
        $pub_category_object = get_the_category( $pub_post_id );
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
        <div class="listing-item">
          <div class="content">
            <div class="listing-text">
              <?php if($eventType ): ?>
              <div class="category-title">
                <h4><?php print $eventType; ?></h4>
              </div>
              <?php endif; ?>
              <h5>
                <?php the_title(); ?>
              </h5>
              <?php if( $event != '' ): ?>
              <div><?php print $event; ?></div>
              <?php endif; ?>
              <?php $link = 'Edit Event'; ?>
              <?php edit_post_link($link, $post_object->ID  ); ?>
            </div>
          </div>
          <div class="cta"> <a href="<?php the_permalink(); ?>" class="download" aria-label="View details about <?php the_title(); ?>">View Details</a> </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // reset the query ?>
