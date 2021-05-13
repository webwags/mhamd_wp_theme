<?php
$full_page_callout = get_field( 'full_page_callouts' );
$half_page_callouts = get_field( 'half_page_callouts' );
$choose_callouts_type = get_field( 'choose_callouts_type' );
global $articleCalloutID;
if ( $full_page_callout || $half_page_callouts || $choose_callouts_type ) {
  if ( $full_page_callout ) {
    $postID_full = $full_page_callout[ 'full_page_callout' ];
    $article_object_full = getArticleQuery();
  } elseif ( $half_page_callouts ) {
    $postID_left = $half_page_callouts[ 'left_callout' ];
    $postID_right = $half_page_callouts[ 'right_callout' ];
    $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
    $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
    $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
    $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
    $article_object_left = $half_page_callouts[ 'left_callout' ];
    $article_object_right = $half_page_callouts[ 'right_callout' ];

    if ( $callout_left_type == 'related-article' ) {
      $articleCalloutID = $postID_left;
      $article_object = getArticleQuery();
    } elseif ( $callout_right_type == 'related-article' ) {
      $articleCalloutID = $postID_right;
      $article_object = getArticleQuery();
    }

  } elseif ( $choose_callouts_type ) {
    $mixType = $choose_callouts_type[ 'callout_type' ];
    if ( $mixType == 1 ) {
      $mixTypeFull = $choose_callouts_type[ 'mix_full_page_callouts' ];
      $postID_full = $mixTypeFull[ 'mix_full_page_callout' ];
      $articleCalloutID = $postID_full;
      $article_object_full = getArticleQuery();


    } elseif ( $mixType == 2 ) {

      $mixTypeHalf = $choose_callouts_type[ 'mix_half_page_callouts' ];
      $postID_left = $mixTypeHalf[ 'mix_left_callout' ];
      $postID_right = $mixTypeHalf[ 'mix_right_callout' ];
      $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
      $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
      $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
      $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );
      $article_object_left = $mixTypeHalf[ 'mix_left_callout' ];
      $article_object_right = $mixTypeHalf[ 'mix_right_callout' ];
      if ( $callout_left_type == 'related-article' ) {
        $articleCalloutID = $postID_left;
        $article_object = getArticleQuery();
      } elseif ( $callout_right_type == 'related-article' ) {
        $articleCalloutID = $postID_right;
        $article_object = getArticleQuery();
      }
    }
  }
}

?>
<?php

function getArticleQuery() {
  global $articleCalloutID;
  $calloutPost = get_post( $articleCalloutID );
  $cat_id = get_field( "related_article_category", $articleCalloutID );


  $current_date = current_time( 'mysql' );

  $args = array(
    'post_type' => 'post',
    'cat' => array( $cat_id ),
    'posts_per_page' => 1,
    'post_status' => array( 'publish' ),
    'order' => 'ASC',
    'orderby' => 'date',
  );

  $wp_query = new WP_Query( $args );

  if ( !( $wp_query->have_posts() ) ) {
    $args = array(
      'post_type' => 'post',
      'cat' => array( 1 ),
      'posts_per_page' => 1,
      'post_status' => array( 'publish' ),
      'order' => 'ASC',
      'orderby' => 'date',
    );

    $wp_query = new WP_Query( $args );

  } else {
    return $wp_query;

  }

}

?>
<?php if( $article_object_full ): ?>
<?php while($article_object_full->have_posts()) : $article_object_full->the_post(); ?>
<div class="btm-module-full">
  <div class="container">
    <div class="tagline">
      <div class="headline">
        <div class="dash"></div>
        <h4>Related Article</h4>
        <div class="dash"></div>
      </div>
      <h2>
        <?php the_title(); ?>
      </h2>
    </div>
    <div class="btm-cta"> <a href="<?php the_permalink(); ?>" class="btn border white">View Article</a> </div>
  </div>
</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;?>
<?php if( $article_object ): ?>
<?php while($article_object->have_posts()) : $article_object->the_post(); ?>
<div class="white-background callout" style="background-image: url(<?php the_field('callout_background_image'); ?>)">
  <div class="white-background-screen">
    <div class="container">
      <div class="content">
        <?php
        $link = 'Edit Post';
        edit_post_link( $link, $post->ID );
        ?>
        <div class="tagline">
          <div class="headline">
            <h4>Related Article</h4>
            <div class="dash"></div>
          </div>
          <h2>
            <?php the_title(); ?>
          </h2>
        </div>
        <?php
        $more = 0;
        $content = get_the_content( '' );
        $content = preg_replace( "/<img[^>]+\>/i", " ", $content );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]>', $content );
        print $content;
        ?>
        <div class="cta"><a href="<?php the_permalink(); ?>" class="btn border purple">View Article</a> <a href="/news" class="btn border purple">View all Articles</a></div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;?>
