<?php $postID=get_the_ID();
$term_obj_full=get_the_terms( $postID, 'project');
$termId=join(', ', wp_list_pluck($term_obj_full, 'term_id'));
$taxonomy=join(', ', wp_list_pluck($term_obj_full, 'taxonomy'));
$term=$taxonomy . '_' . $termId;
$project_primary_color_hex=get_field('project_primary_color', $term);
$project_primary_color_rgba=hex2rgb($project_primary_color_hex);
$project_secondary_color_hex=get_field('project_secondary_color', $term);
$project_secondary_color_rgba=hex2rgb($project_secondary_color_hex);
$themeURL = get_template_directory_uri();
if ($project_primary_color_hex=='') {
    $project_primary_color_hex=' #9C528B';
}

if ($project_secondary_color_hex=='') {
    $project_secondary_color_hex=' #98815f';
}

if ($project_primary_color_rgba=='') {
    $project_primary_color_rgba=' rgba(68, 36, 61, 0.5)';
}

if ($project_secondary_color_rgba=='') {
    $project_secondary_color_rgba=' rgba(152, 129, 95, 0.5)';
}

?> <style type="text/css" > main .listing-block.grid-layout .listing-item .category-title {
    background-color: <?php print $project_primary_color_hex;
    ?>;
}

main .listing-block.grid-layout .listing-item .download:hover {
    border-color: <?php print $project_primary_color_hex;
    ?>;
    transition: all .3s ease;
}

main a.post-edit-link {
    background-color: <?php print $project_primary_color_hex;
    ?>;
    border: 2px solid <?php print $project_primary_color_hex;
    ?>;
    color: #FFF;
}

main a.post-edit-link:hover {
    background-color: #fff;
    border: 2px solid <?php print $project_primary_color_hex;
    ?>;
    color: <?php print $project_primary_color_hex;
    ?> !Important;
}

main .btm-module-full .btm-cta a {
    color: #FFF;
}

main .btm-module-full .btm-cta a:hover {
    color: <?php print $project_secondary_color_hex;
    ?>;
}

main h2 {
    color: <?php print $project_primary_color_hex;
    ?>;
}

main a {
    color: <?php print $project_primary_color_hex;
    ?>;
}

main a:hover {
    color: <?php print $project_secondary_color_hex;
    ?>;
}

main .dash {
    background-color: <?php print $project_primary_color_hex;
    ?>;
}

main .btn.border.purple {
    color: <?php print $project_secondary_color_hex;
    ?>;
    box-sizing: border-box;
    border: 2px solid <?php print $project_secondary_color_hex;
    ?>;
}

main .btn.border.purple:hover {
    color: #FFFFFF !important;
    background-color: <?php print $project_secondary_color_hex;
    ?>;
    border-color: <?php print $project_secondary_color_hex;
    ?>;
    box-shadow: 0px 0px 15px 7px <?php print $project_secondary_color_rgba;
    ?>;
}

main .headline.centered .dash {
    background-color: <?php print $project_primary_color_hex;
    ?>;
}

main .btm-module-full {
    background-color: <?php print $project_secondary_color_hex;
    ?>;
}

main .btm-module-full .tagline .dash {
    background-color: #ffffff;
}

main .btm-module-full h2 {
    color: #ffffff;
}

main .angled-base {
    background-image: url('<?php print $themeURL ; ?>/css/images/angled-base.png');
}

main .listing-block.grid-layout .listing-item .listing-img {
    background-color: <?php print $project_primary_color_hex;
    ?>;
}

main .listing-block.grid-layout .listing-item .content .listing-text {
    padding: 40px 38px 90px;
}

main .listing-block.grid-layout .listing-item .download {
    border-bottom: 2px <?php print $project_secondary_color_hex;
    ?> solid;
    color: <?php print $project_primary_color_hex;
    ?>;
}

main .listing-block.grid-layout .listing-item .download:hover {
    color: <?php print $project_secondary_color_hex;
    ?>;
    border-color: <?php print $project_primary_color_hex;
    ?>;
}

main .brand-nav .brand-specific-nav .mobile-dropdown .fa {
    color: <?php print $project_secondary_color_hex;
    ?>;
}

main .module-50-50 .image.right img {
    width: 100%;
    box-shadow: -15px 15px <?php print $project_secondary_color_rgba;
    ?>;
}

main .module-50-50 .image.left img {
    width: 100%;
    box-shadow: 15px 15px <?php print $project_primary_color_rgba;
    ?>;
}

main .brand-nav .brand-specific-nav ul.nav-items li {
    font-family: 'Open Sans', sans-serif;
    font-weight: 400;
    color: #000000;
    font-size: 13px;
    line-height: 27px;
    padding: 10px;
    background: url(images/bullet.png) no-repeat 0 10px;
    padding-left: 25px;
    margin: 0;
    vertical-align: top;
    background: unset;
    padding-right: 0px;
    padding-left: 25px;
}

main .brand-nav .brand-specific-nav .nav-items li a:hover {
    color: <?php print $project_secondary_color_hex;
    ?>;
    transition: all .3s ease;
}

main .brand-nav .brand-nav-mobile .menu li > div:hover {
    border-bottom: 1px <?php print $project_secondary_color_hex;
    ?> solid;
    transition: all .3s ease;
}

main .brand-nav .brand-nav-mobile .menu li > div:hover h4 {
    color: <?php print $project_secondary_color_hex;
    ?>;
    transition: all .3s ease;
}

main .white-background.callout .headline h4 {
    color: <?php print $project_secondary_color_hex;
    ?>;
}

main .white-background.callout .headline .dash {
    background-color: <?php print $project_secondary_color_hex;
    ?>;
}

main .purple-background.callout h2 {
    color: #FFFFFF;
}

main .purple-background.callout .headline .dash {
    background-color: #FFFFFF;
}

main .purple-background-screen {
    background-color: <?php print $project_secondary_color_rgba;
    ?>;
}

main .btm-module-50-50 .module .purple-background {
    background-color: <?php print $project_secondary_color_hex;
    ?>;
}

main .brand-nav .brand-specific-nav ul.nav-items .social {
    padding-right: 0;
    padding-left: 14px;
    padding-top: 3px;
    float: right;
}

main .btn.border.white:hover {
    color: <?php print $project_secondary_color_hex;
    ?>;
}

main .featured {
    background-color: <?php print $project_primary_color_hex;
    ?>;
}
main .general-content h3 {
    color: <?php print $project_primary_color_hex;
    ?>;
}

</style>