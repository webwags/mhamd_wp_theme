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
        $postType = get_field( 'post_type' );
        ?>
        <div class="listing-item">
          <div class="content">
            <div class="listing-text">
              <?php if( $postType  ): ?>
              <div class="category-title">
                <h4><?php print $postType ; ?></h4>
              </div>
              <?php endif; ?>
              <h5>
                <?php the_title(); ?>
              </h5>
              <p>
                <?php the_time('F jS, Y'); ?>
              </p>
              <?php
              $more = 0;

              $content = get_the_content( '' );
              $content = strip_tags( $content );
              showBeforeMore( $content );


              ?>
            </div>
            <?php $link = 'Edit Post'; ?>
            <?php edit_post_link($link, $post_object->ID  ); ?>
          </div>
          <div class="cta"><a href="<?php the_permalink(); ?>" class="download" aria-label="Read More about <?php the_title(); ?>" >Read More</a></div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); // reset the query ?>
