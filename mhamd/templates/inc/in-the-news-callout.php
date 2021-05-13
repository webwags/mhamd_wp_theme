<?php
$full_page_callout = get_field( 'full_page_callouts' );
$half_page_callouts = get_field( 'half_page_callouts' );
$choose_callouts_type = get_field( 'choose_callouts_type' );

if ( $full_page_callout || $half_page_callouts || $choose_callouts_type ) {
  if ( $full_page_callout ) {
    $post_object_full = $full_page_callout[ 'full_page_callout' ];
  } elseif ( $half_page_callouts ) {
    $postID_left = $half_page_callouts[ 'left_callout' ];
    $postID_right = $half_page_callouts[ 'right_callout' ];
    $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
    $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
    $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
    $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
    $post_object_left = $half_page_callouts[ 'left_callout' ];
    $post_object_right = $half_page_callouts[ 'right_callout' ];

    if ( $callout_left_type == 'in-the-news' ) {
      $post_object = $postID_left;
    } elseif ( $callout_right_type == 'in-the-news' ) {
      $post_object = $postID_right;
    }

  } elseif ( $choose_callouts_type ) {
    $mixType = $choose_callouts_type[ 'callout_type' ];
    if ( $mixType == 1 ) {
      $mixTypeFull = $choose_callouts_type[ 'mix_full_page_callouts' ];
      $post_object_full = $mixTypeFull[ 'mix_full_page_callout' ];


    } elseif ( $mixType == 2 ) {

      $mixTypeHalf = $choose_callouts_type[ 'mix_half_page_callouts' ];
      $postID_left = $mixTypeHalf[ 'mix_left_callout' ];
      $postID_right = $mixTypeHalf[ 'mix_right_callout' ];
      $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
      $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
      $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
      $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
      $post_object_left = $mixTypeHalf[ 'mix_left_callout' ];
      $post_object_right = $mixTypeHalf[ 'mix_right_callout' ];
      global $post_object;
      if ( $callout_left_type == 'in-the-news' ) {
        $post_object = $postID_left;
      } elseif ( $callout_right_type == 'in-the-news' ) {
        $post_object = $postID_right;
      }
    }
  }
}

?>
<?php

if ( $post_object_full ):
  $post = $post_object_full;
setup_postdata( $post );
$link = 'Edit Callout';
edit_post_link( $link, $post->ID );
$subHead = get_field( 'callout_subheadline' );
$cta2Text = get_field( 'callout_cta_2_button_text' );
$cta2URL = get_field( 'callout_cta_2_button_url' );

?>
<div class="btm-module-full">
  <div class="container">
    <div class="tagline">
      <?php if( $subHead != ''): ?>
      <div class="headline">
        <div class="dash"></div>
        <h4>
          <?php the_field('callout_subheadline'); ?>
        </h4>
        <div class="dash"></div>
      </div>
      <?php endif;?>
      <h2>
        <?php the_field('callout_headline'); ?>
      </h2>
    </div>
    <div class="btm-cta"> <a href="<?php the_field('callout_cta_1_button_url'); ?>" class="btn border white">
      <?php the_field('callout_cta_1_button_text'); ?>
      </a>
      <?php if(( $cta2URL != '') && ( $cta2Text !='')): ?>
      <a href="<?php the_field('callout_cta_2_button_url'); ?>" class="btn border white">
      <?php the_field('callout_cta_2_button_text'); ?>
      </a>
      <?php endif;?>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;?>
<?php if( $post_object_left || $post_object_right): ?>
<?php

if ( $post_object ):

  // override $post
  $post = $post_object;
setup_postdata( $post );
$link = 'Edit Callout';
$subHead = get_field( 'callout_subheadline' );
$cta2Text = get_field( 'callout_cta_2_button_text' );
$cta2URL = get_field( 'callout_cta_2_button_url' );
?>
<div class="white-background callout" style="background-image: url(<?php the_field('callout_background_image'); ?>)">
  <div class="white-background-screen">
    <div class="container">
      <div class="content">
        <?php edit_post_link($link, $post->ID  ); ?>
        <div class="tagline">
          <?php if( $subHead != ''): ?>
          <div class="headline">
            <h4>
              <?php the_field('callout_subheadline'); ?>
            </h4>
            <div class="dash"></div>
          </div>
          <?php endif;?>
          <h2>
            <?php the_field('callout_headline'); ?>
          </h2>
        </div>
        <?php the_field('callout_summary'); ?>
        <div class="cta"><a href="<?php the_field('callout_cta_1_button_url'); ?>" class="btn border purple">
          <?php the_field('callout_cta_1_button_text'); ?>
          </a>
          <?php if(( $cta2URL != '') && ( $cta2Text !='')): ?>
          <a href="<?php the_field('callout_cta_2_button_url'); ?>" class="btn border purple">
          <?php the_field('callout_cta_2_button_text'); ?>
          </a>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;?>
<?php endif;?>
