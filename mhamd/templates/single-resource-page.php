<?php
/*
Template Name: Resource
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
    $link = 'Edit Resource';
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
      <div class="entry-links">
        <?php wp_link_pages(); ?>
      </div>
    </div>
  </article>
  <?php
  $symptoms = get_field( 'symptoms' );
  $symptomsBullets = $symptoms[ 'symptoms_bulleted_list' ];
  if ( ( $symptoms[ 'symptoms_intro_paragraph' ] ) || ( $symptoms[ 'symptoms_bulleted_list' ][ 0 ][ 'bulleted_items' ] ) ): ?>
  <section>
    <div class="info-block gray-bg">
      <div class="container">
        <div class="description symptoms">
          <div class="headline">
            <h2><?php print $symptoms['symptoms_title']; ?></h2>
            <div class="dash"></div>
          </div>
          <?php print $symptoms['symptoms_intro_paragraph']; ?> 
        </div>
        <?php if($symptomsBullets ): ?>
        <ul class="bullets circle">
          <?php
          foreach ( $symptomsBullets as $bullet ): // variable must be called $post (IMPORTANT) ?>
          <li>
            <p> <?php print $bullet['bulleted_items']; ?> </p>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php
  $treatmentsStudies = get_field( 'treatments_studies' );
  $treatmentsStudiesBlocks = $treatmentsStudies[ 'treatments_studies_blocks' ];
  if ( ( $treatmentsStudies[ 'treatments_studies_intro_paragraph' ] ) || ( $treatmentsStudies[ 'treatments_studies_blocks' ] ) ): ?>
  <section style="margin-bottom: -30px;">
    <div class="info-block white-bg angled-base-short">
      <div class="container">
        <div class="description treatments-studies">
          <div class="headline">
            <h2><?php print $treatmentsStudies['treatments_studies_title'] ?></h2>
            <div class="dash"></div>
          </div>
          <?php print $treatmentsStudies['treatments_studies_intro_paragraph'] ?> </div>
        <?php if( $treatmentsStudiesBlocks): ?>
        <div class="four-column clearfix">
          <?php
          foreach ( $treatmentsStudiesBlocks as $block ): // variable must be called $post (IMPORTANT) ?>
          <div class="one-column">
            <div class="listing-text">
              <h5><?php print $block['treatment_studies_block_title']; ?></h5>
              <p> <?php print $block['treatment_studies_block_text']; ?> </p>
            </div>
            <?php if( ($block['treatment_studies_block_cta_url']) && ( $block['treatment_studies_block_cta_text']) ): ?>
            <div class="cta"> <a href="<?php print $block['treatment_studies_block_cta_url']; ?>" class="btn border purple"> <?php print $block['treatment_studies_block_cta_text']; ?> </a> </div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php
  $relatedResources = get_field( 'related_resources' );
  $relatedResourcesBlocks = $relatedResources[ 'related_resource_blocks' ];
  $post_objects = array();
  ( !empty( $relatedResourcesBlocks[ 0 ][ 'related_resource' ] ) ? array_push( $post_objects, $relatedResourcesBlocks[ 0 ][ 'related_resource' ] ) : '' );
  ( !empty( $relatedResourcesBlocks[ 1 ][ 'related_resource' ] ) ? array_push( $post_objects, $relatedResourcesBlocks[ 1 ][ 'related_resource' ] ) : '' );
  ( !empty( $relatedResourcesBlocks[ 2 ][ 'related_resource' ] ) ? array_push( $post_objects, $relatedResourcesBlocks[ 2 ][ 'related_resource' ] ) : '' );

  if ( $post_objects ): ?>
  <section>
    <div class="listing-block gray-bg with-slider">
      <div class="container">
        <div class="description centered related-resources">
          <div class="headline centered">
            <div class="dash"></div>
            <h2><?php print $relatedResources['related_resource_title'];?></h2>
            <div class="dash"></div>
          </div>
        </div>
        <div class="three-column mobile-hide">
          <?php
          $link = 'Edit Resource';
          global $more;
          ?>
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <?php
          setup_postdata( $post );
          ?>
          <?php
          $postID = get_the_ID();
          $test = get_post( $postID );
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
              <?php if($dated): ?>
                <h4><?php print $dated;?></h4>
                 <?php endif; ?>
                <h5>
                  <?php the_title(); ?>
                </h5>
                <div class="dash"> </div>
                <?php
                $content = get_the_content();
                if ( $content ) {
                  $content = strip_tags( $content );
                  showBeforeMore( $content );
                }

                $eventText = get_field( 'content_wysiwyg_copy' );
                if ( $eventText ) {
                  showBeforeMore( $eventText );
                }

                $publicationText = get_field( 'content_copy' );
                if ( $publicationText ) {
                  showBeforeMore( $publicationText );
                }

                ?>

                <?php
                $link = 'Edit Resource';
                edit_post_link( $link );
                ?>
              </div>
            </div>
            <div class="cta">
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
                <a href="<?php the_field('publication_bulk_mail_form'); ?>" target="_blank" class="download" aria-label="Open form about <?php the_title(); ?>">In the Mail
                <div class="hidden-ada">Opens in a new window.</div>
                </a>
                <?php endif; ?>
              </div>
              <?php if( get_field('event_type')): ?>
              <a href="<?php the_permalink(); ?>" class="download">View Details</a>
              <?php endif; ?>
              <?php if( get_field('post_type')): ?>
              <a href="<?php the_permalink(); ?>" class="download" aria-label="Read More about <?php the_title(); ?>">Read More</a>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
        <div class="three-column slider">
          <?php
          $link = 'Edit Resource';
          global $more;
          ?>
          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
          <?php
          setup_postdata( $post );
          ?>
          <?php
          $postID = get_the_ID();
          $test = get_post( $postID );
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
                $more = 0;

                $content = get_the_content( '' );
                $content = preg_replace( "/<img[^>]+\>/i", " ", $content );
                $content = apply_filters( 'the_content', $content );
                $content = str_replace( ']]>', ']]>', $content );
                print $content;

                $eventText = get_field( 'content_wysiwyg_copy' );
                if ( $eventText ) {
                  showBeforeMore( $eventText );
                }

                $publicationText = get_field( 'content_copy' );
                if ( $publicationText ) {
                  showBeforeMore( $publicationText );
                }

                ?>
                <?php
                $link = 'Edit Resource';
                edit_post_link( $link );
                ?>
              </div>
            </div>
            <div class="cta">
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
                <a href="<?php the_field('publication_bulk_mail_form'); ?>" target="_blank" class="download" aria-label="Open form about <?php the_title(); ?>">In the Mail
                <div class="hidden-ada">Opens in a new window.</div>
                </a>
                <?php endif; ?>
              </div>
              <?php if( get_field('event_type')): ?>
              <a href="<?php the_permalink(); ?>" class="download">View Details</a>
              <?php endif; ?>
              <?php if( get_field('post_type')): ?>
              <a href="<?php the_permalink(); ?>"  class="download">Read More</a>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
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
