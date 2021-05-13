<?php
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
    $link = 'Edit Custom Page';
    edit_post_link( $link );
    ?>
    <div class="entry-content">
      <?php if( (get_field('content_title')) || (get_field('content_wysiwyg_copy')) ): ?>
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
          <?php the_field('content_wysiwyg_copy'); ?>
        </div>
      </div>
      <?php
      $donationPage = get_field( 'donation_page' );
      $donationBlocks = $donationPage[ 'donation_blocks' ];
      $donationOWTGBlocks = $donationPage[ 'donation_other_ways_to_give_blocks' ];
      $donationCTA = $donationPage[ 'donation_cta' ];
      /*    
      print '<pre>';
      print_r($donationCTA);
      print '</pre>';
      */
      ?>
      <?php endif; ?>
      <div class="entry-links">
        <?php wp_link_pages(); ?>
      </div>
    </div>
  </article>
  <?php if( $donationBlocks ): ?>
  <?php $post_objects = $donationBlocks; ?>
  <section>
    <div class="donate-module-50-50">
      <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
      <?php setup_postdata($post); ?>
      <div class="module get-involved">
        <div class="container">
          <div class="content"> <img src="<?php print $post['donation_icon']; ?>" alt="<?php print $post['donation_tilte']; ?> Icon">
            <div class="headline">
              <h2><?php print $post['donation_tilte']; ?></h2>
              <div class="dash white"></div>
            </div>
            <?php print $post['donation_summary']; ?>
            <div class="cta"> <a href="<?php print $post['donation_cta_button_url']; ?>" class="btn border white"><?php print $post['donation_cta_button_text']; ?></a> </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    </div>
  </section>
  <?php endif; ?>
  <?php if( $donationOWTGBlocks ): ?>
  <?php $post_objects = $donationOWTGBlocks; ?>
  <section>
    <div class="angled-base-bkg">
      <div class="listing-block angled-base btm">
        <div class="container">
          <div class="description centered">
            <div class="headline centered">
              <div class="dash"></div>
              <h2>Other Ways To Give</h2>
              <div class="dash"></div>
            </div>
          </div>
          <div class="three-blocks">
            <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
            <div class="listing-item">
              <div class="content no-cta">
                <div class="listing-text">
                  <h5><?php print $post['donation_owtg_tilte']; ?></h5>
                  <div class="dash"></div>
                  <?php print $post['donation_owtg_copy']; ?>
                  <p>&nbsp;</p>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php if( $donationCTA ): ?>
  <?php $post_object = $donationCTA; ?>
  <section>
    <div class="general-content base gray-bg">
      <div class="container">
        <?php // override $post
        $post = $post_object;
        setup_postdata( $post );
        ?>
        <h3><?php print $post['donation_cta_summary']; ?></h3>
        <p><br/>
          <a href="<?php print $post['donation_cta_button_url']; ?>" class="btn border purple"><?php print $post['donation_cta_button_text']; ?></a></p>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php

  $half_page_callouts = get_field( 'half_page_callouts' );


  if ( $half_page_callouts ) {
    $postID_left = $half_page_callouts[ 'left_callout' ];
    $postID_right = $half_page_callouts[ 'right_callout' ];
    $term_obj_left = get_the_terms( $postID_left, 'callout_type' );
    $term_obj_right = get_the_terms( $postID_right, 'callout_type' );
    $callout_left_type = join( ', ', wp_list_pluck( $term_obj_left, 'slug' ) );
    $callout_right_type = join( ', ', wp_list_pluck( $term_obj_right, 'slug' ) );

  }

  ?>
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
