<?php
/*
Template Name: Custom Page
Template Post Type: page
*/
?>
<?php $custom_page = get_field('custom_page_type'); ?>
<?php  getCustomPageTemplate($custom_page); ?>
