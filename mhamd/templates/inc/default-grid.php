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
          <div class="content">
            <div class="listing-text">
              <?php if( ($pub_category_name  != 'All Categories') ): ?>
              <div class="category-title">
                <h4><?php print $pub_category_name ; ?></h4>
              </div>
              <?php endif; ?>
              <h5>
                <?php the_title(); ?>
              </h5>
              <?php $link = 'Edit Publication'; ?>
              <?php edit_post_link($link, $post_object->ID  ); ?>
            </div>
          </div>
          <div class="cta">
            <?php if( get_field('en_publication') || get_field('es_publication') || get_field('publication_bulk_mail_form') ): ?>
            <div>
              <?php if( get_field('en_publication') && (get_field('publication_language') == 'English')): ?>
              <a href="<?php the_field('en_publication'); ?>" target="_blank" class="download" >Download
              <div class="hidden-ada">Opens in a new window.</div>
              </a>
              <?php endif; ?>
              <?php if( get_field('es_publication') && (get_field('publication_language') == 'Spanish' )): ?>
              <a href="<?php the_field('es_publication'); ?>" target="_blank" class="download" >Download
              <div class="hidden-ada">Opens in a new window.</div>
              </a>
              <?php endif; ?>
              <?php if( get_field('publication_bulk_mail_form')): ?>
              <a href="<?php the_field('publication_bulk_mail_form'); ?>" target="_blank" class="download" >In the Mail
              <div class="hidden-ada">Opens in a new window.</div>
              </a>
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // reset the query ?>
