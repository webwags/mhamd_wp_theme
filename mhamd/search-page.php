<?php
/*
Template Post Type: page
*/
$search = new WP_Advanced_Search( 'searchform' );
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
    <div class="filter-block">
      <div class="form-line clearfix">
        <?php $search->the_form(); ?>
      </div>
    </div>
    <div class="search-results">
      <div id="wpas-results"></div>
      <!-- This is where our results will be loaded --> 
    </div>
    <div class="entry-links">
      <?php wp_link_pages(); ?>
    </div>
    </div>
  </article>
</main>
<?php get_footer(); ?>
