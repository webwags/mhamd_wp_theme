<?php 
/*
 * 404.php
 * This file should be created in the root of your theme directory
 */
$search = new WP_Advanced_Search('searchform');
get_header();
?>
<main id="content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="header">
    <div class="featured static" >
        <div class="container">
            <div class="content">
                <h1 class="entry-title">Page Not Found</h1>

                <h3>Try Searching for the information</h3>

            </div>
        </div>
    </div>
   
</div>

<div class="filter-block">
      <div class="form-line clearfix">
      <?php $search->the_form(); ?>
   </div>
 </div>

   <div class="search-results large-9 columns">
         <div id="wpas-results"></div> <!-- This is where our results will be loaded -->
   </div>


                                <div class="entry-links">
                                    <?php wp_link_pages(); ?>
                                </div>
                    </div>
</article>

</main>
<?php 
get_footer();
?>