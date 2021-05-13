<?php
get_header();
?>
<?php
$aboutPage = get_field( 'about_page' );
$aboutReports = $aboutPage[ 'about_reports' ];
$aboutOfficers = $aboutPage[ 'about_officers' ];
$aboutBOD = $aboutPage[ 'about_board_of_directors' ];
$aboutHonoraryBOD = $aboutPage[ 'about_honorary_board_of_directors' ];
?>
<main id="content">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="header">
      <div class="featured video" style="background-image: url(<?php the_field('background_image'); ?>)">
        <div id="playvideo"><?php print $aboutPage['about_video']; ?></div>
        <div class="background"></div>
        <div class="container">
          <div id="yt_vid" class="youtube" > <img src="<?php print get_template_directory_uri() ; ?>/css/images/play-2.png" alt="Play Video">
            <h1 class="entry-title"><?php print $aboutPage['about_video_title']; ?></h1>
            <h3><?php print $aboutPage['about_video_subtitle']; ?></h3>
          </div>
        </div>
      </div>
      <?php projectMenu(); ?>
      <?php
      $link = 'Edit Custom Page';
      edit_post_link( $link );
      ?>
      <div class="entry-content"> </div>
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
      <?php endif; ?>
      <div class="entry-links">
        <?php wp_link_pages(); ?>
      </div>
    </div>
  </article>
  <?php if( $aboutReports ): ?>
  <?php $post_objects = $aboutReports; ?>
  <section>
    <div class="listing-block gray-bg with-slider">
      <div class="container">
        <div class="description centered">
          <div class="headline centered">
            <div class="dash"></div>
            <h2>Reports</h2>
            <div class="dash"></div>
          </div>
        </div>
        <div class="three-column mobile-hide">
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <?php
          setup_postdata( $post );
          print_r( $post );
          $ctaButton = '#';
          $ctaTarget = '';
          $ctaADA = '';
          if ( ( $post[ 'about_report_cta_button_url' ] ) && ( $post[ 'about_report_cta_button_type' ] == 'Link' ) ) {
            $ctaButton = $post[ 'about_report_cta_button_url' ];
          };
          if ( ( $post[ 'about_report_cta_button_file' ] ) && ( $post[ 'about_report_cta_button_type' ] == 'PDF' ) ) {
            $ctaButton = $post[ 'about_report_cta_button_file' ];
            $ctaTarget = 'target="_blank"';
            $ctaADA = '<div class="hidden-ada">Opens in a new window.</div>';
          };
          ?>
          <div class="listing-item about"><a <?php print $ctaTarget; ?> href="<?php print $ctaButton; ?>">
            <div class="content centered">
              <div class="listing-text">
                <div class="badge">
                  <div class="icon-contain"><img src="<?php print $post['about_report_icon']; ?>" alt="<?php print $post['about_report_name']; ?> Icon"></div>
                </div>
                <h5><?php print $post['about_report_name']; ?></h5>
                <div class="dash"></div>
                <p><?php print $post['about_report_text']; ?></p>
              </div>
            </div>
            <div class="cta-center">
              <div class="btn about purple"><?php print  $post['about_report_cta_button_text']; ?></div>
            </div>
            <?php print $ctaADA; ?></a> </div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
        <div class="three-column slider">
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <?php setup_postdata($post); ?>
          <div class="listing-item about"> <a href="<?php print $post['about_report_cta_button_file']; ?>">
            <div class="content centered">
              <div class="listing-text">
                <div class="badge">
                  <div class="icon-contain"><img src="<?php print $post['about_report_icon']; ?>" alt="<?php print $post['about_report_name']; ?> Icon"></div>
                </div>
                <h5><?php print $post['about_report_name']; ?></h5>
                <div class="dash"></div>
                <p><?php print $post['about_report_text']; ?></p>
              </div>
            </div>
            <div class="cta-center">
              <div class="btn about purple"><?php print  $post['about_report_cta_button_text']; ?></div>
            </div>
            </a></div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php if(   ($aboutOfficers) || ($aboutBOD) || ($aboutHonoraryBOD)): ?>
  <section>
    <div class="info-block white-bg">
      <div class="container">
        <?php if($aboutOfficers): ?>
        <div>
          <div class="headline">
            <h2>Officers</h2>
            <div class="dash"></div>
          </div>
        </div>
        <ul class="bullets listing no-bullet">
          <?php $post_objects = $aboutOfficers; ?>
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <li>
            <h5><?php print $post['about_officers_name']; ?></h5>
            <p><?php print $post['about_officers_title']; ?></p>
          </li>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </ul>
        <?php endif; ?>
        <?php if($aboutBOD): ?>
        <div>
          <div class="headline">
            <h2>Board of Directors</h2>
            <div class="dash"></div>
          </div>
        </div>
        <ul class="bullets listing no-bullet">
          <?php $post_objects = $aboutBOD; ?>
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <li>
            <p><?php print $post['about_bod_name_and_location']; ?></p>
          </li>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </ul>
        <?php endif; ?>
        <?php if($aboutHonoraryBOD): ?>
        <div>
          <div class="headline">
            <h2>Honorary Board Members</h2>
            <div class="dash"></div>
          </div>
        </div>
        <ul class="bullets listing no-bullet">
          <?php $post_objects = $aboutHonoraryBOD; ?>
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <li>
            <p><?php print $post['about_honorary_bod_name']; ?></p>
          </li>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </ul>
        <?php endif; ?>
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
        <a href="<?php print $post['donation_cta_button_url']; ?>" class="btn border purple"><?php print $post['donation_cta_button_text']; ?></a>
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
get_footer();
?>
