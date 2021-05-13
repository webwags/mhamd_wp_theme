<?php
$full_page_callout = get_field( 'full_page_callouts' );
$half_page_callouts = get_field( 'half_page_callouts' );
$choose_callouts_type = get_field( 'choose_callouts_type' );
global $eventCalloutID;
if ( $full_page_callout || $half_page_callouts || $choose_callouts_type ) {
  if ( $full_page_callout ) {
    $postID_full = $full_page_callout[ 'full_page_callout' ];
    $event_object_full = getEventQuery();
  } elseif ( $half_page_callouts ) {
    $postID_left = $half_page_callouts[ 'left_callout' ];
    $postID_right = $half_page_callouts[ 'right_callout' ];
    $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
    $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
    $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
    $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
    $event_object_left = $half_page_callouts[ 'left_callout' ];
    $event_object_right = $half_page_callouts[ 'right_callout' ];

    if ( $callout_left_type == 'upcoming-event' ) {
      $eventCalloutID = $postID_left;
      $event_object = getEventQuery();
    } elseif ( $callout_right_type == 'upcoming-event' ) {
      $eventCalloutID = $postID_right;
      $event_object = getEventQuery();
    }

  } elseif ( $choose_callouts_type ) {
    $mixType = $choose_callouts_type[ 'callout_type' ];
    if ( $mixType == 1 ) {
      $mixTypeFull = $choose_callouts_type[ 'mix_full_page_callouts' ];
      $postID_full = $mixTypeFull[ 'mix_full_page_callout' ];
      $eventCalloutID = $postID_full;
      $event_object_full = getEventQuery();


    } elseif ( $mixType == 2 ) {

      $mixTypeHalf = $choose_callouts_type[ 'mix_half_page_callouts' ];
      $postID_left = $mixTypeHalf[ 'mix_left_callout' ];
      $postID_right = $mixTypeHalf[ 'mix_right_callout' ];
      $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
      $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
      $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
      $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
      $event_object_left = $mixTypeHalf[ 'mix_left_callout' ];
      $event_object_right = $mixTypeHalf[ 'mix_right_callout' ];
      if ( $callout_left_type == 'upcoming-event' ) {
        $eventCalloutID = $postID_left;
        $event_object = getEventQuery();
      } elseif ( $callout_right_type == 'upcoming-event' ) {
        $eventCalloutID = $postID_right;
        $event_object = getEventQuery();
      }
    }
  }
}

?>
<?php

function getEventQuery() {
  global $eventCalloutID;
  $calloutPost = get_post( $eventCalloutID );
  $cat_id = get_field( "related_upcoming_event", $eventCalloutID );

  // $related_upcoming_event = $calloutPost[related_upcoming_event];
  //$cat_id = 260; //get_field('related_upcoming_event');
  $current_date = current_time( 'mysql' );

  $args = array(
    'post_type' => 'event',
    'cat' => array( $cat_id ),
    'posts_per_page' => 1,
    'post_status' => array( 'publish' ),
    'order' => 'ASC',
    'orderby' => 'event_start_date',
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'event_start_date',
        'value' => $current_date,
        'compare' => '>='
      ),
      array(
        'key' => 'event_end_date',
        'value' => $current_date,
        'compare' => '>='
      )
    )

  );

  $wp_query = new WP_Query( $args );

  if ( !( $wp_query->have_posts() ) ) {
    $args = array(
      'post_type' => 'event',
      'cat' => array( 1 ),
      'posts_per_page' => 1,
      'post_status' => array( 'publish' ),
      'order' => 'ASC',
      'orderby' => 'event_start_date',
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key' => 'event_start_date',
          'value' => $current_date,
          'compare' => '>='
        ),
        array(
          'key' => 'event_end_date',
          'value' => $current_date,
          'compare' => '>='
        )
      )

    );
    $wp_query = new WP_Query( $args );

  } else {
    return $wp_query;

  }

}


?>
<?php if( $event_object_full ): ?>
<?php while($post_object_full->have_posts()) : $event_object_full->the_post(); ?>
<div class="btm-module-full">
  <div class="container">
    <div class="tagline">
      <div class="headline">
        <div class="dash"></div>
        <h4>Upcoming Event</h4>
        <div class="dash"></div>
      </div>
      <h2>
        <?php the_title(); ?>
      </h2>
    </div>
    <div class="btm-cta"> <a href="<?php the_permalink(); ?>" class="btn border white">View Event</a> </div>
  </div>
</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;?>
<?php if( $event_object ): ?>
<?php while($event_object->have_posts()) : $event_object->the_post(); ?>
<div class="purple-background callout">
  <div class="container">
    <div class="content">
      <?php
      $link = 'Edit Event';
      edit_post_link( $link, $post->ID );
      ?>
      <div class="tagline">
        <div class="headline">
          <h4>Upcoming Event</h4>
          <div class="dash"></div>
        </div>
        <h2>
          <?php the_title(); ?>
        </h2>
      </div>
      <?php
      $more = 0;
      $eventText = get_field( 'content_wysiwyg_copy' );
      showBeforeMore( $eventText );
      ?>
      <div class="cta"><a href="<?php the_permalink(); ?>" class="btn border white">View Event</a> <a href="/events" class="btn border white">View all Events</a></div>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;?>
