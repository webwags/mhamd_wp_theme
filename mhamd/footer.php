</div>
<?php $orgName = get_field('organization_information', 'option' );?>
<?php $siteFooter = get_field('site_footer', 'option' );?>
<footer id="footer">
  <div class="container">
    <div class="contact">
      <div class="contact-item"> <a><img src="<?php echo get_template_directory_uri(); ?>/images/phone-icon.png" alt="Phone">
        <p><?php print $orgName['organization_phone_number']; ?></p>
        <div class="hidden-ada">Opens in a new window.</div>
        </a> </div>
      <div class="contact-item"> <a target="_blank" href="mailto:<?php print $orgName['organization_email']; ?>?subject=Contact <?php print $orgName['organization_acronym']; ?> "><img src="<?php echo get_template_directory_uri(); ?>/images/email-icon.png" alt="Email - opens in a new window">
        <p><?php print $orgName['organization_email']; ?></p>
        <div class="hidden-ada">Opens in a new window.</div>
        </a> </div>
      <a href="/contact/" class="btn border purple">Get in Touch</a> </div>
    <div class="company-info">
      <div class="address">
        <p><?php print $orgName['organization_location']; ?><br/>
          <?php print $orgName['organization_street_address']; ?>, <?php print $orgName['organization_street_address_continued']; ?><br/>
          <?php print $orgName['organization_city']; ?>, <?php print $orgName['organization_state']; ?> <?php print $orgName['organization_zip']; ?></p>
      </div>
    </div>
    <div class="contact-mobile">
      <div class="contact-cta"> <a href="/contact/" class="btn border purple">Get in Touch</a> </div>
    </div>
    <div class="copyright">
      <div class="social">
        <?php
        $socialMedia = get_field( 'social_media', 'option' );
        if ( $socialMedia ) {
          print '<div class="social">';
          foreach ( $socialMedia as $social ) {
            print '<a target="_blank" href="' . $social[ 'social_media_url' ] . '" ><img src="' . $social[ 'social_media_icon' ] . '" alt="' . $social[ 'social_media_name' ] . '- opens in a new window"><div class="hidden-ada">Opens in a new window.</div></a>';

          }
          print '</div>';

        }
        ?>
      </div>
      <p><?php print $siteFooter['copyright_tag']; ?></p>
    </div>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slick.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script> 
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=psmmqun9odmlcwfg1cn31q" async="true"></script>
</body></html>