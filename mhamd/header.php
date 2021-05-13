<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php
wp_head();
$themeURL = get_template_directory_uri();
wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', false, '1.1', 'all' );
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
projectPalette();
?>
<?php $googleTagManager = get_field('google_tag_manager', 'option' ); ?>
<?php print $googleTagManager['gtm_header_code']; ?>
</head>

<body <?php body_class(); ?>>
<?php print $googleTagManager['gtm_body_code']; ?>
<div <?php projectActive(); ?> class="hfeed">
<header id="header">
  <div class="utility-nav" <?php //if ( is_user_logged_in() ) { print 'style="margin-top: 20px;"'; } ?> >
    <div class="container">
      <?php
      $socialMedia = get_field( 'social_media', 'option' );
      if ( $socialMedia ) {
        print '<div class="social">';
        print '<ul class="nav-items">';
        foreach ( $socialMedia as $social ) {
          print '<li><a target="_blank" href="' . $social[ 'social_media_url' ] . '"><img src="' . $social[ 'social_media_icon' ] . '" alt="' . $social[ 'social_media_name' ] . '- opens in a new window"><div class="hidden-ada">Opens in a new window.</div></a></li>';

        }
        print '</ul>';
        print '</div>';

      }
      ?>
      <div class="utilities">
        <ul class="nav-items">
          <?php  wp_nav_menu(array( 'menu' => 'Utilities Menu', 'items_wrap'=>'%3$s', 'container' => false ) ); ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="primary-nav drop-shadow">
    <?php $orgName = get_field('organization_information', 'option' );?>
    <div class="logo">
      <?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { print '<h1>'; } ?>
      <a href="<?php print esc_url( home_url( '/' ) ); ?>" title="<?php print $orgName['organization_full_name']; ?>" rel="home"><img src="<?php print $themeURL ; ?>/images/logo-header.png" alt="<?php print $orgName['organization_acronym']; ?>"></a>
      <?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { print '</h1>'; } ?>
    </div>
    <div class="main-nav">
      <nav id="menu">
        <div class="primary-items">
          <ul class="nav-items">
            <?php expand_menu_items();?>
          </ul>
        </div>
      </nav>
      <div id="hamburger-nav" class="hamburger-nav closed">
        <div class="bar top"></div>
        <div class="bar mid"></div>
        <div class="bar btm"></div>
      </div>
    </div>
  </div>
  <div class="mobile-nav">
    <div class="mobile-menu menu-opened">
      <div class="primary-menu">
        <ul class="menu">
          <?php expand_mobile_menu_items();?>
        </ul>
      </div>
      <div class="utility-menu">
        <div class="utilities">
          <ul class="nav-items">
            <?php  wp_nav_menu(array( 'menu' => 'Utilities Menu', 'items_wrap'=>'%3$s', 'container' => false ) ); ?>
          </ul>
        </div>
        <div class="social">
          <ul class="nav-items">
            <?php
            $socialMedia = get_field( 'social_media', 'option' );
            if ( $socialMedia ) {
              print '<li>';
              foreach ( $socialMedia as $social ) {
                print '<a target="_blank" href="' . $social[ 'social_media_url' ] . '"><img src="' . $social[ 'social_media_icon' ] . '" alt="' . $social[ 'social_media_name' ] . '- opens in a new window"><div class="hidden-ada">Opens in a new window.</div></a>';

              }
              print '</li>';

            }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <?php
    $siteHeader = get_field( 'site_header', 'option' );
    if ( $siteHeader[ 'left_cta_button_text' ] || $siteHeader[ 'left_cta_button_url' ] || $siteHeader[ 'right_cta_button_text' ] ): ?>
    <div class="mobile-cta menu-opened">
      <?php if( $siteHeader['left_cta_button_text'] && $siteHeader['left_cta_button_url'] ): ?>
      <a href="<?php print $siteHeader['left_cta_button_url']; ?>" class="donate">
      <h4><?php print $siteHeader['left_cta_button_text']; ?></h4>
      </a>
      <?php endif ?>
      <?php if( $siteHeader['right_cta_button_text'] ): ?>
      <a class="help">
      <h4><?php print $siteHeader['right_cta_button_text']; ?></h4>
      </a>
      <?php endif ?>
    </div>
    <?php endif ?>
  </div>
  <?php
  $modal = get_field( 'modal_title', 'option' );

  if ( $modal ): ?>
  <div class="immediate-help-modal">
    <div class="exit">
      <div><a aria-label="Close Modal Window"><img src="<?php print $themeURL ; ?>/images/modal-exit.png" alt="Exit Menu"></a></div>
    </div>
    <div class="container">
      <div class="inner-container">
        <div class="headline centered">
          <div class="dash"></div>
          <h2>
            <?php the_field('modal_title', 'option'); ?>
          </h2>
          <div class="dash"></div>
        </div>
        <h5>
          <?php the_field('modal_subtitle', 'option'); ?>
        </h5>
        <div class="hotline">
          <h4>
            <?php the_field('above_modal_phone_number_text', 'option'); ?>
          </h4>
          <h2>
            <?php the_field('modal_phone_number', 'option'); ?>
          </h2>
          <h5>
            <?php the_field('below_phone_number_text', 'option'); ?>
          </h5>
          <h4>
            <?php the_field('above_modal_alt_phone_number_text', 'option'); ?>
          </h4>
          <h2>
            <?php the_field('modal_alt_phone_number', 'option'); ?>
          </h2>
        </div>
        <p>
          <?php the_field('above_modal_text_button', 'option'); ?>
        </p>
        <a target="_blank" href="<?php the_field('modal_cta_button_url', 'option'); ?>" class="btn border purple">
        <?php the_field('modal_cta_button_text', 'option'); ?>
        <div class="hidden-ada">Opens in a new window.</div>
        </a>
        
        <br><br><br><br>
        
        <p>
          <?php the_field('above_modal_text_button_copy', 'option'); ?>
        </p>
        <a target="_blank" href="<?php the_field('modal_cta_button_url_copy', 'option'); ?>" class="btn border purple">
        <?php the_field('modal_cta_button_text_copy', 'option'); ?>
        <div class="hidden-ada">Opens in a new window.</div>
        </a>

      </div>
    </div>
  </div>
  <?php endif ?>
</header>
<div id="container">
