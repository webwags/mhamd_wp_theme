<?php
get_header();
?>
<?php
$homePage = get_field( 'homepage' );
$homepageSlider = $homePage[ 'homepage_slider' ];
$aboutSection = $homePage[ 'homepage_about_section' ];
$whatWeDoSection = $homePage[ 'homepage_what_we_do_section' ];
$resourcesSection = $homePage[ 'homepage_resources_section' ];
$resourcesLinks = $resourcesSection[ 'resources_links' ];
$advocacySection = $homePage[ 'homepage_advocacy_section' ];
$advocacyBlocks = $advocacySection[ 'advocacy_blocks' ];
$trainingSection = $homePage[ 'homepage_training_section' ];
$trainingBlocks = $trainingSection[ 'training_blocks' ];
$outreachSection = $homePage[ 'homepage_community_outreach_section' ];
$outreachBlocks = $outreachSection[ 'community_outreach_blocks' ];
$ctaSection = $homePage[ 'homepage_consumer_quality_team_block' ];

?>
<main id="home">
<?php if( $homepageSlider ): ?>
<?php
$num = 1;
$next = 0;
?>
<div class="featured slider">
  <?php $post_objects = $homepageSlider; ?>
  <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
  <?php setup_postdata($post); ?>
  <?php $next = $num + 1; ?>
  <div class="slide <?php print 'number' . $num; ?>" style="background-image: url(<?php print $post['slider_image']; ?>)">
    <div class="container">
      <div class="content">
        <h3><?php print $post['slider_subheadline']; ?></h3>
        <h2><?php print $post['slider_headline']; ?></h2>
        <?php print $post['slider_copy']; ?>
        <div class="cta"><a href="<?php print $post['slider_cta_button_url']; ?>" class="btn border white"><?php print $post['slider_cta_button_text']; ?></a><a href="<?php print $post['slider_donate_button_url']; ?>" class="btn fill purple"><?php print $post['slider_donate_button_text']; ?></a></div>
      </div>
    </div>
  </div>
  <?php $num = $next; ?>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
</div>
<?php endif; ?>
<?php if( $aboutSection ): ?>
<?php $post_object = $aboutSection; ?>
<section>
<div class="homepage-about">
<?php
$link = 'Edit Custom Page';
edit_post_link( $link );
?>
<div class="container">
  <?php // override $post
  $post = $post_object;
  setup_postdata( $post );
  ?>
  <div class="intro-module-50-50 white-bg">
    <div class="container">
      <div class="module left">
        <div class="content">
          <div class="headline">
            <h4>About MHAMD</h4>
            <div class="dash"></div>
          </div>
          <h2><?php print $post['about_summary_title']; ?></h2>
          <div class="cta"> <a href="<?php print $post['about_cta_button_url']; ?>" class="btn border purple"><?php print $post['about_cta_button_text']; ?></a> </div>
        </div>
      </div>
      <div class="module right">
        <div class="content"> <?php print $post['about_summary']; ?> </div>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
</div>
</section>
<?php endif; ?>
<?php if($whatWeDoSection): ?>
<section>
  <div class="services-block">
    <?php $post_objects = $whatWeDoSection; ?>
    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
    <?php setup_postdata($post); ?>
    <div class="one-column">
      <div class="container">
        <div class="background-hover" style="background-image: url(<?php print $post['what_we_do_background_image']; ?>)"></div>
        <div class="background-color"></div>
        <div class="content">
          <h5><?php print $post['what_we_do_title']; ?></h5>
          <div class="dash white"></div>
          <?php print $post['what_we_do_excerpt']; ?> <a href="<?php print $post['what_we_do_cta_url']; ?>" class="btn border white"><?php print $post['what_we_do_cta_text']; ?></a> </div>
      </div>
    </div>
    <?php endforeach; ?>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
  </div>
</section>
<?php endif; ?>
<?php if( $resourcesSection ): ?>
<section>
  <div class="resources-block gray-bg">
    <?php if( ($resourcesSection['resources_summary_title']) || ($resourcesSection['resources_summary']) ): ?>
    <?php $post_object = $resourcesSection; ?>
    <?php // override $post
    $post = $post_object;
    setup_postdata( $post );
    ?>
    <div class="section-left">
      <div class="container">
        <div class="content">
          <div class="headline">
            <h2><?php print $post['resources_summary_title']; ?></h2>
            <div class="dash"></div>
          </div>
          <?php print $post['resources_summary']; ?> </div>
      </div>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif; ?>
    <?php if( $resourcesLinks ): ?>
    <?php $post_objects = $resourcesLinks; ?>
    <div class="section-right">
      <div class="container">
        <div class="inner-container">
          <ul class="resources-menu">
            <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
            <li class="menu-item"> <a href="<?php print $post['resources_link_url']; ?>" class="menu-link">
              <h5><?php print $post['resources_link_name']; ?></h5>
              <div class="arrow"></div>
              </a> </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
<?php if( $advocacySection ): ?>
<section>
  <div class="listing-block white-bg angled-base-short  advocacy-container">
    <div class="container">
      <?php if( ($advocacySection['advocacy_summary_title']) || ($advocacySection['advocacy_summary']) ): ?>
      <?php $post_object = $advocacySection; ?>
      <?php // override $post
      $post = $post_object;
      setup_postdata( $post );
      ?>
      <div class="description centered">
        <div class="headline centered">
          <div class="dash"></div>
          <h2><?php print $post['advocacy_summary_title']; ?></h2>
          <div class="dash"></div>
        </div>
        <?php print $post['advocacy_summary']; ?> 
      </div>
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>
      <?php if( $advocacyBlocks ): ?>
      <div class="four-column clearfix">
        <?php $post_objects = $advocacyBlocks; ?>
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <div class="one-column">
          <div class="content centered">
            <div class="listing-text">
              <div class="badge">
                <div class="icon-contain"><img src="<?php print $post['advocacy_block_icon']; ?>" alt="<?php print $post['advocacy_block_title']; ?> Icon"></div>
              </div>
              <h5><?php print $post['advocacy_block_title']; ?></h5>
              <?php print $post['advocacy_block_excerpt']; ?> </div>
          </div>
          <div class="cta-center"> <a href="<?php print $post['advocacy_block_cta_url']; ?>" class="btn border purple"><?php print  $post['advocacy_block_cta_text']; ?></a> </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if( $trainingSection ): ?>
<section>
  <div class="listing-block gray-bg with-slider">
    <div class="container training-container" >
      <?php if( ($trainingSection['training_summary_title']) || ($trainingSection['training_summary']) ): ?>
      <?php $post_object = $trainingSection; ?>
      <?php // override $post
      $post = $post_object;
      setup_postdata( $post );
      ?>
      <div class="description centered">
        <div class="headline centered">
          <div class="dash"></div>
          <h2><?php print $post['training_summary_title']; ?></h2>
          <div class="dash"></div>
        </div>
        <?php print $post['training_summary']; ?> 
        </div>
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>
      <?php if( $trainingBlocks ): ?>
      <div class="three-column mobile-hide">
        <?php $post_objects = $trainingBlocks; ?>
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <div class="listing-item">
          <div class="listing-img"><img src="<?php print $post['training_block_image']; ?>" alt="<?php print $post['training_block_title']; ?>"></div>
          <div class="content centered">
            <div class="listing-text">
              <h5><?php print $post['training_block_title']; ?></h5>
              <?php print $post['training_block_excerpt']; ?> </div>
          </div>
          <div class="cta-center"><a href="<?php print $post['training_block_cta_url']; ?>" class="btn border purple"><?php print $post['training_block_cta_text']; ?></a></div>
        </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      </div>
      <div class="three-column slider">
        <?php $post_objects = $trainingBlocks; ?>
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <div class="listing-item">
          <div class="listing-img"><img src="<?php print $post['training_block_image']; ?>" alt="<?php print $post['training_block_title']; ?>"></div>
          <div class="content centered">
            <div class="listing-text">
              <h5><?php print $post['training_block_title']; ?></h5>
              <?php// print $post[training_block_excerpt]; ?>
            </div>
          </div>
          <div class="cta-center"><a href="<?php print $post['training_block_cta_url']; ?>" class="btn border purple"><?php print $post['training_block_cta_text']; ?></a></div>
        </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if( $outreachSection ): ?>
<section>
  <div class="listing-block white-bg with-slider">
    <div class="container">
      <?php if( ($outreachSection['community_outreach_summary_title']) || ($outreachSection['community_outreach_summary']) ): ?>
      <?php $post_object = $outreachSection; ?>
      <?php // override $post
      $post = $post_object;
      setup_postdata( $post );
      ?>
      <div class="description centered">
        <?php if( $post['community_outreach_summary_title'] ): ?>
        <div class="headline centered">
          <div class="dash"></div>
          <h2><?php print $post['community_outreach_summary_title']; ?></h2>
          <div class="dash"></div>
        </div>
        <?php  endif; ?>
        <?php if( $post['community_outreach_summary'] ): ?>
        <?php print $post['community_outreach_summary']; ?>
        <?php  endif; ?>
      </div>
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php  endif; ?>
      <?php if( $outreachBlocks ): ?>
      <div class="three-column mobile-hide">
        <?php $post_objects = $outreachBlocks; ?>
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <div class="listing-item">
          <div class="listing-img"><img src="<?php print $post['community_outreach_block_image']; ?>" alt="<?php print $post['community_outreach_block_title']; ?>"></div>
          <div class="content centered">
            <div class="listing-text">
              <h5><?php print $post['community_outreach_block_title']; ?></h5>
              <?php print $post['community_outreach_block_excerpt']; ?> 
              </div>
          </div>
          <div class="cta-center"><a href="<?php print $post['community_outreach_block_cta_url']; ?>" class="btn border purple"><?php print $post['community_outreach_block_cta_text']; ?></a></div>
        </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      </div>
      <div class="three-column slider">
        <?php $post_objects = $outreachBlocks; ?>
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); ?>
        <div class="listing-item">
          <div class="listing-img"><img src="<?php print $post['community_outreach_block_image']; ?>" alt="<?php print $post['community_outreach_block_title']; ?>"></div>
          <div class="content centered">
            <div class="listing-text">
              <h5><?php print $post['community_outreach_block_title']; ?></h5>
              <?php // print $post['community_outreach_block_excerpt']; ?>
            </div>
          </div>
          <div class="cta-center"><a href="<?php print $post['community_outreach_block_cta_url']; ?>" class="btn border purple"><?php print $post['community_outreach_block_cta_text']; ?></a></div>
          </div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if( $ctaSection ): ?>
<section>
  <?php if( ($ctaSection['cqt_block_title']) || ($ctaSection['cqt_block_copy']) ): ?>
  <?php $post_object = $ctaSection; ?>
  <?php // override $post
  $post = $post_object;
  setup_postdata( $post );
  ?>
  <?php
  $summary_image = $post[ 'cqt_block_image' ];
  $url = $summary_image[ 'url' ];
  $title = $summary_image[ 'title' ];
  $alt = $summary_image[ 'alt' ];
  $size = 'landing';
  $thumb = $summary_image[ 'sizes' ][ $size ];
  ?>
  <div class="module-50-50">
    <div class="image right "> <img src="<?php print esc_url($thumb); ?>" alt="<?php print esc_attr($alt); ?>" /> </div>
    <div class="content left">
      <div class="container">
        <div class="headline">
          <h2><?php print $post['cqt_block_title']; ?></h2>
          <div class="dash"></div>
        </div>
        <h5><?php print $post['cqt_block_copy']; ?></h5>
        <div><a class="btn border purple" href="<?php print $post['cqt_block_cta_button_url']; ?>"><?php print $post['cqt_block_cta_button_text']; ?></a></div>
      </div>
    </div>
  </div>

  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
  <?php  endif; ?>
</section>
<?php endif; ?>
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
/*     
print '<pre>';
print_r($homepageSlider);
print '</pre>';
*/

?>
