<?php
/**
 *
 * @package mhamd
 */

$postID = get_the_ID();
$term_obj_full = get_the_terms( $postID, 'project' );
$termId = join( ', ', wp_list_pluck( $term_obj_full, 'term_id' ) );
$taxonomy = join( ', ', wp_list_pluck( $term_obj_full, 'taxonomy' ) );
$term = $taxonomy . '_' . $termId;

$project_title = get_field( 'project_title', $term );
$project_url = get_field( 'project_landing_page_url', $term );
$project_logo = get_field( 'project_logo', $term );
$project_menu_items = get_field( 'project_menu_items', $term );
$project_facebook_url = get_field( 'project_facebook_url', $term );
$project_twitter_url = get_field( 'project_twitter_url', $term );
$project_linkedin_url = get_field( 'project_linkedin_url', $term );
$project_instagram_url = get_field( 'project_instagram_url', $term );

?>
<div class="brand-nav">
  <div class="brand-nav-desktop">
    <div class="logo"> <a href="<?php print $project_url; ?>">
      <?php if( $project_logo ): ?>
      <img src="<?php print $project_logo; ?>" alt="<?php print $project_title; ?>">
      <?php else: ?>
      <h5><?php print $project_title; ?></h5>
      <?php endif; ?>
      </a> </div>
    <div class="brand-specific-nav">
      <div class="mobile-dropdown"><i class="open-brand-nav closed fa fa-angle-down"></i></div>
      <div class="container">
        <ul class="nav-items">
          <?php foreach( $project_menu_items as $project_menu_item ): // variable must be called $post (IMPORTANT) ?>
          <li><a href="<?php print $project_menu_item['project_menu_item_url']; ?>"><?php print $project_menu_item['project_menu_item_name']; ?></a></li>
          <?php endforeach; ?>
          <?php if( $project_instagram_url): ?>
          <li class="social"><a target="_blank" href="<?php print $project_instagram_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/ig-brand-nav.png" alt="Instagram">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
          <?php if( $project_linkedin_url): ?>
          <li class="social"><a target="_blank" href="<?php print $project_linkedin_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/in-brand-nav.png" alt="Linkedin">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
          <?php if( $project_twitter_url): ?>
          <li class="social"><a target="_blank" href="<?php print $project_twitter_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/twitter-brand-nav.png" alt="Twitter">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
          <?php if( $project_facebook_url): ?>
          <li class="social"><a target="_blank" href="<?php print $project_facebook_url ; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/fb-brand-nav.png" alt="Facebook">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="brand-nav-mobile">
    <div class="container">
      <ul class="menu">
        <?php foreach( $project_menu_items as $project_menu_item ): // variable must be called $post (IMPORTANT) ?>
        <li>
          <div><a href="<?php print $project_menu_item['project_menu_item_url']; ?>">
            <h4><?php print $project_menu_item['project_menu_item_name']; ?></h4>
            </a></div>
        </li>
        <?php endforeach; ?>
      </ul>
      <div class="social">
        <ul class="nav-items">
          <?php if( $project_facebook_url): ?>
          <li><a target="_blank" href="<?php print $project_facebook_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/fb-brand-nav.png" alt="Facebook">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
          <?php if( $project_twitter_url): ?>
          <li><a target="_blank" href="<?php print $project_twitter_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/twitter-brand-nav.png" alt="Twitter">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
          <?php if( $project_linkedin_url): ?>
          <li><a target="_blank" href="<?php print $project_linkedin_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/in-brand-nav.png" alt="Linkedin">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
          <?php if( $project_instagram_url): ?>
          <li><a target="_blank" href="<?php print $project_instagram_url; ?>"><img src="<?php print get_template_directory_uri() ; ?>/images/ig-brand-nav.png" alt="Instagram">
            <div class="hidden-ada">Opens in a new window.</div>
            </a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
