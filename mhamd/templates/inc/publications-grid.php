<?php
global $wpex_query;
?>
<div class="angled-base-bkg">
  <div class="listing-block angled-base">
    <div class="container">
      <div class="three-column">
        <?php
        while ( $wpex_query->have_posts() ): $wpex_query->the_post();
        $pub_post_id = get_the_ID(); // or use the post id if you already have it
        $pub_category_object = get_the_category( $pub_post_id );
        $pub_category_name = $pub_category_object[ 0 ]->name;
        ?>
        <div class="listing-item">
          <?php $publication_image = get_field('publication_image'); ?>
          <?php if( $publication_image): ?>
          <?php
          $url = $publication_image[ 'url' ];
          $title = $publication_image[ 'title' ];
          $alt = $publication_image[ 'alt' ];
          $size = 'publication';
          $thumb = $publication_image[ 'sizes' ][ $size ];
          ?>
          <div class="listing-img"> <img src="<?php print esc_url($thumb); ?>" alt="<?php print esc_attr($alt); ?>" /></div>
          <?php endif; ?>
          <div class="content">
            <div class="listing-text">
              <?php if( $pub_category_name  ): ?>
              <?php if( ($pub_category_name  != 'All Categories') ): ?>
              <div class="category-title">
                <h4><?php print $pub_category_name ; ?></h4>
              </div>
              <?php endif; ?>
              <?php endif; ?>
              <h5>
                <?php the_title(); ?>
              </h5>
              <?php $link = 'Edit Publication'; ?>
              <?php edit_post_link($link, $post_object->ID  ); ?>
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
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // reset the query ?>
