<?php
add_action( 'after_setup_theme', 'mhamd_setup' );
function mhamd_setup() {
load_theme_textdomain( 'mhamd', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }


register_nav_menus( 
  array( 
    'main-menu' => esc_html__( 'Main Menu', 'mhamd' ),
    'utilities-menu' => esc_html__( 'Utilities Menu', 'mhamd' ),
     ) );
}


add_action( 'wp_enqueue_scripts', 'mhamd_load_scripts' );
function mhamd_load_scripts() {
wp_enqueue_style( 'mhamd-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'mhamd_footer_scripts' );
function mhamd_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'mhamd_document_title_separator' );
function mhamd_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'mhamd_title' );
function mhamd_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'mhamd_read_more_link' );
function mhamd_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'mhamd_excerpt_read_more_link' );
function mhamd_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'mhamd_image_insert_override' );
function mhamd_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'mhamd_widgets_init' );
function mhamd_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'mhamd' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'mhamd_pingback_header' );
function mhamd_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'mhamd_enqueue_comment_reply_script' );
function mhamd_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function mhamd_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'mhamd_comment_count', 0 );
function mhamd_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
/*
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'custom_page'; // change to your post type
	$taxonomy  = 'custom_page_type'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}

add_action('admin_init', 'force_post_title_init');
add_action('edit_page_form', 'force_post_title');
function force_post_title_init() 
{
  wp_enqueue_script('jquery');
}
function force_post_title() 
{
  $validation_message = _("The title field is required.");
  echo "<script type='text/javascript'>\n";
  echo "
  var validator_snippet = '<p style=\"font-size: 13px; line-height: 1.5; margin: 0; padding: 10px; text-shadow: none; color: #d12626;\">" . $validation_message . "</p>'; 
  jQuery('#publish').click(function(){
        var testervar = jQuery('[id^=\"titlediv\"]')
        .find('#title');
        if (testervar.val().length < 1)
        {
        	
            jQuery('[id^=\"edit-slug-box\"]').css('background', '#ffe6e6');
			jQuery('[id^=\"edit-slug-box\"]').html( validator_snippet);
            setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
            setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
            return false;
        }else{
        	jQuery('[id^=\"edit-slug-box\"]').css('background', '##f1f1f1');
			jQuery('[id^=\"edit-slug-box\"]').detach();
        }
    });
  ";
   echo "</script>\n";
}


if(function_exists('acf_add_options_page')) {
	acf_add_options_page('Site Options');
}



//remove Feature Image from pages
add_action( 'admin_menu', 'remove_thumbnail_box' );
function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv', 'post', 'side' );
}

//remove comments from pages
add_action('init', 'remove_comment_support', 100);
function remove_comment_support() {
remove_post_type_support( 'page', 'comments' );
}

//remove WYSIWYG Editor from pages
add_action( 'admin_init', 'hide_editor_options' );
function hide_editor_options() {
  remove_post_type_support('page', 'editor');
}

//Float Blocks left or right on landing pages
function position_image($number) 
{    
    // One 
    $one = 1; 
    // Bitwise AND 
    $bitwiseAnd = $number & $one;   
    if($bitwiseAnd == 1) 
    { 
        echo "right";  
    } 
    else{ 
        echo "left"; 
    } 
} 
function position_text($number) 
{   
    // One 
    $one = 1;   
    // Bitwise AND 
    $bitwiseAnd = $number & $one; 
    if($bitwiseAnd == 1) 
    { 
       echo "left"; 
    } 
    else{ 
         echo "right";  
    } 
} 


/** MENU DISPLAY **/
function loop_thru_the_menus_ftw($menu){

  $new_array = array();
  $first_child  = 999999999999;
  $second_child = 9999999999999;
  $third_child  = 99999999999999;
  foreach ($menu as $menu_item) {
if ($menu_item->url  != '') {
    if ($menu_item->menu_item_parent == 0) {
      $current_parent = $menu_item->ID;
      $new_array[$menu_item->ID] = array( "title" => $menu_item->title, "url" => $menu_item->url );
    }
    if ($menu_item->menu_item_parent == $current_parent) {
      $first_child = $menu_item->ID;
      $new_array[$current_parent]["level1"][$menu_item->ID] = array( "title" => $menu_item->title, "url" => $menu_item->url );
    }
    if ($menu_item->menu_item_parent == $first_child) {
      $second_child = $menu_item->ID;
      $new_array[$current_parent]["level1"][$first_child]["level2"][$menu_item->ID] = array( "title" => $menu_item->title, "url" => $menu_item->url );
    }
    if ($menu_item->menu_item_parent == $second_child) {
      $third_child = $menu_item->ID;
      $new_array[$current_parent]["level1"][$first_child]["level2"][$second_child]["level3"][$menu_item->ID] = array( "title" => $menu_item->title, "url" => $menu_item->url );
    }
  }
  }
  return $new_array;
}


function expand_menu_items() {
$themeURL = get_template_directory_uri();
$menu = wp_get_nav_menu_items( 'Main Menu', array() );
$menus_filtered = loop_thru_the_menus_ftw($menu);
/*
echo '<pre>';
print_r($menus_filtered);
echo '</pre>';
*/
  print '<div class="primary-items">';         
    print '<ul class="nav-items">';
      foreach ($menus_filtered as $item) {
        print '<li class="item dropdown"><a class="nav-link"  href="' . $item['url'] . '">' . $item['title'] . '</a>';
          if ( array_key_exists("level1", $item) ) {
            print '<div class="subnav one">';
              print '<div class="main-menu menu-opened">';
                print '<ul class="menu">';
                  foreach ($item['level1'] as $k1 => $v1) {
                    print '<li class="menu-item" ><a href="' . $v1['url'] . '"><h4>' . $v1['title'] . '</h4></a>';
                     if( isset($v1['level2']) && !empty($v1['level2']) ){ print '<div class="arrow"></div>';  };
                         
                            if ( isset($v1['level2']) && !empty($v1['level2']) ) {
                            print '<div class="sub-menu">';
                              print '<div class="sub-previous">';
                                print '<h3>Previous Menu</h3>';
                                print '</div>';
                                 print '<div style="background-color: #fff;">';
                                  print '<ul class="menu">';
                                    foreach ($v1['level2'] as $k2 => $v2) {
                                      print '<li class="menu-item" ><a href="' . $v2['url'] . '"><h4>' . $v2['title'] . '</h4></a>';
                                        if( isset($v2['level3']) && !empty($v2['level3']) ){ print '<div class="arrow"></div>';  };
              
                                        if ( isset($v2['level3']) && !empty($v2['level3']) ) {
                                          print '<div class="sub-sub-menu">';
                                            print '<div class="sub-sub-previous">';
                                                  print '<h3>Previous Menu</h3>';
                                            print '</div>';
                                             print '<div style="background-color: #fff;">';
                                              print '<ul class="menu">';
                                                foreach ($v2['level3'] as $k3 => $v3) {
                                                print '<li class="menu-item" ><a href="' . $v3['url'] . '"><h4>' . $v3['title'] . '</h4></a></li>';
                                                            }//foreach_l3
                                              print '</ul>';
                                            print '</div>';
                                            print '</div>';
                                          }//isset_level_3
                                          print '</li>';
                                        }//foreach_l2
                                      print '</ul>';
                                      print '</div>';
                                    print '</div>';
                                  }//isset_level_2
                                  print '</li>';
                                }//foreach_l1
                              print '</ul>';
                            print '</div>';
                          print '</div>';
                        }//array_key_1
                       print '</li>';
                      }//foreach_main
                  $siteHeader = get_field('site_header', 'option' ); 
                
                if( $siteHeader['right_cta_button_text'] ){
                print '<li class="item help"><a class="btn fill purple">' . $siteHeader['right_cta_button_text'] . '</a></li>';
                }
                if( $siteHeader['left_cta_button_text'] && $siteHeader['left_cta_button_url'] ){
                print '<li class="item donate"><a href="' . $siteHeader['left_cta_button_url'] . '" class="btn border purple">' . $siteHeader['left_cta_button_text'] . '</a></li>';
                };
                    print '</ul>';
                  print '</div>';
}

  
function expand_mobile_menu_items() {
$themeURL = get_template_directory_uri();
$menu = wp_get_nav_menu_items( 'Main Menu', array() );
$menus_filtered = loop_thru_the_menus_ftw($menu);

       $num = 1;
       $next = 0;

  print '<div class="primary-item">';         
    print '<ul class="mobile-menu mobile-opened" style="background-color: #fff;">';
      foreach ($menus_filtered as $item) {
        $next = $num + 1; 
        print '<li class="menu-item item' . $num . '"><a class="nav-link"  href="' . $item['url'] . '"><h4>' . $item['title'] . '</h4></a>';
        if( isset($item['level1']) && !empty($item['level1']) ){ print '<div class="arrow"></div>';  };
          if ( array_key_exists("level1", $item) ) {
            print '<div class="level-1-menu " style="background-color: #fff;">';
                print '<div class="sub-previous">';
                  print '<h3>' . $item['title'] . '</h3>';
                    print '</div>';
                     print '<div style="background-color: #fff;">';
                      print '<ul class="menu menu-level">';
                        foreach ($item['level1'] as $k1 => $v1) {
                          print '<li class="menu-item" id="menu-item-' . $k1 . '"><a href="' . $v1['url'] . '"><h4>' . $v1['title'] . '</h4></a>';
                           if( isset($v1['level2']) && !empty($v1['level2']) ){ print '<div class=" accordion"></div>';  };
                            
                                  if ( isset($v1['level2']) && !empty($v1['level2']) ) {
                              			print '<div class="level-2-menu panel" style="background-color: #fff;">';
                                          print '<div style="background-color: #fff;">';
                                        print '<ul class="menu menu-level">';
                                          foreach ($v1['level2'] as $k2 => $v2) {
                                            print '<li class="menu-item" id="menu-item-' . $k2 . '"><a href="' . $v2['url'] . '"><h4>' . $v2['title'] . '</h4></a>';
                                              if( isset($v2['level3']) && !empty($v2['level3']) ){ print '<div class=" accordion"></div>';  };
                                          
                                              if ( isset($v2['level3']) && !empty($v2['level3']) ) {
                                                print '<div class="level-3-menu panel" style="background-color: #fff;">';
 
                                                          print '<div  style="background-color: #fff;">';
                                                    print '<ul class="menu menu-level">';
                                                      foreach ($v2['level3'] as $k3 => $v3) {
                                                      print '<li class="menu-item" id="menu-item-' . $k3 . '"><a href="' . $v3['url'] . '"><h4>' . $v3['title'] . '</h4></a></li>';
                                                            }//foreach_l3
                                                    print '</ul>';
                                                  print '</div>';
                                                print '</div>';
                                            }//isset_level_3

                                          }//foreach_l2
                                           print '</li>';
                                      print '</ul>';
                                    print '</div>';
                                  print '</div>';
                                  }//isset_level_2
                                }//foreach_l1
                                print '</li>'; 
                              print '</ul>';
                            print '</div>';
                          print '</div>';
                        }//array_key_1
                       print '</li>';
                       $num = $next;
                      }//foreach_main
                    print '</ul>';
                  print '</div>';
}




 function getCalloutTemplate ($callout_type){
if( $callout_type){

switch($callout_type) {

    case 'related-article':
        get_template_part( 'templates/inc/related-article', 'callout' );
    break;
    case 'upcoming-event':
        get_template_part( 'templates/inc/upcoming-event', 'callout' );
    break;
    case 'immediate-help':
        get_template_part( 'templates/inc/immediate-help', 'callout' );
    break;
    case 'get-involved':
        get_template_part( 'templates/inc/get-involved', 'callout' );
    break;
    case 'in-the-news':
        get_template_part( 'templates/inc/in-the-news', 'callout' );
    break;
    case 'help-make-a-change':
        get_template_part( 'templates/inc/help-make-a-change', 'callout' );
    break;
    case 'donation':
       get_template_part( 'templates/inc/donation', 'callout' );
    break;
    default :
        get_template_part( 'templates/inc/donation', 'callout' );
    break;

    };

}
}
 function getGridTemplate ($grid_type){


if( $grid_type){

switch($grid_type) {

    case 'publication':
        get_template_part( 'templates/inc/publications', 'grid' );
    break;
    case 'event':
        get_template_part( 'templates/inc/events', 'grid' );
    break;
    case 'post':
        get_template_part( 'templates/inc/post', 'grid' );
    break;
    case 'resource':
        get_template_part( 'templates/inc/resources', 'grid' );
    break;
    default :
        get_template_part( 'templates/inc/default', 'grid' );
    break;

    };

}
}
 function getCustomPageTemplate ($custom_page){


if( $custom_page){

switch($custom_page) {

    case 'about':
        get_template_part( 'templates/custom-about', 'page' );
    break;
    case 'donation':
        get_template_part( 'templates/custom-donation', 'page' );
    break;
    default :
        get_template_part( 'front', 'page' );
    break;

    };

}
}
function hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        $rgba =  'rgba(' . $r .', ' . $g .', ' .  $b . ', 0.5);';
        return $rgba ;
}
function projectPalette() {

$postID = get_the_ID();
$term_obj_full = get_the_terms( $postID, 'project' );
$termId = join(', ', wp_list_pluck($term_obj_full, 'term_id'));
  
if($termId != ''){
require_once 'css/project-css.php';
}
}

function projectMenu() {

$postID = get_the_ID();
$term_obj_full = get_the_terms( $postID, 'project' );
$termId = join(', ', wp_list_pluck($term_obj_full, 'term_id'));
  
if($termId != ''){
   get_template_part( 'templates/inc/project-menu' );
}else{};
}
function projectActive() {

$postID = get_the_ID();
$term_obj_full = get_the_terms( $postID, 'project' );
$termId = join(', ', wp_list_pluck($term_obj_full, 'term_id'));
  
if($termId != ''){
print ' id="brand-site" ';
}else{
print ' id="wapper" ';

}
}
// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {
  
  function wpex_pagination() {
    
    /*    
    $prev_arrow = is_rtl() ? '→' : '←';
    $next_arrow = is_rtl() ? '←' : '→';
    */
    $prev_arrow = is_rtl() ? '' : '';
    $next_arrow = is_rtl() ? '' : '';
    
    global $wpex_query;
    $total = $wpex_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if( $total > 1 )  {
       if( !$current_page = get_query_var('paged') )
         $current_page = 1;
       if( get_option('permalink_structure') ) {
         $format = 'page/%#%/';
       } else {
         $format = '&paged=%#%';
       }
      print '<!-- pagination --><div id="pagination" class="pagination-block gray-bg"><div class="container"><h4 class="pages">Pages </h4> ' . paginate_links(array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => $format,
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $total,
        'mid_size'    => 3,
        'type'      => 'plain',
        'prev_next'   => false,
       ) ) . '</div></div>';
    }
  }
  
}
function showBeforeMore($fullText){
    if(strpos($fullText, '<!--more-->') > 0){
        $morePos = strpos($fullText, '<!--more-->');
        print substr($fullText,0,$morePos);
    } else {
      $fullText = strip_tags($fullText);
      $fullText = substr($fullText,0, 300);
      $break = strrpos($fullText, ' ');
      $fullText = substr($fullText,0, $break);
      $fullText = '<p>' . $fullText . '&hellip;</p>';
      print  $fullText; 
    }
}
// NOT IN USE  UPCOMING EVENT default post=283 Immediate Help Callout
function defaultCalloutPurple($calloutEventID){
 
}
//  NOT IN USE  RELATED ARTICLE default post=713 Get Involved Callout
function defaultCalloutWhite($calloutArticleID){

}

function title_filter($where, &$wp_query){
    global $wpdb;
    if($search_term = $wp_query->get( 'title_filter' )){
        $search_term = $wpdb->esc_like($search_term); //instead of esc_sql()
        $search_term = ' \'%' . $search_term . '%\'';
        $title_filter_relation = (strtoupper($wp_query->get( 'title_filter_relation'))=='OR' ? 'OR' : 'AND');
        $where .= ' '.$title_filter_relation.' ' . $wpdb->posts . '.post_title LIKE '.$search_term;
    }
    return $where;
}
require_once('wp-advanced-search/wpas.php');

function ajax_search() {
    $args = array();
   $args['wp_query'] = array( 'post_type' => array('page', 'publication', 'field', 'praram', 'event', 'post'),

                               'orderby' => 'date', 
                               'order' => 'DESC',
                               'post_status' => array( 'publish' ) );

    $args['form'] = array( 'auto_submit' => true );
  

    $args['form']['ajax'] = array( 'enabled' => true,
                                   'show_default_results' => false,
                                   'results_template' => 'templates/inc/search-results.php', 
                                   'button_text' => 'Show More Results');


    $args['fields'][] = array( 'type' => 'search', 
                               'placeholder' => 'Enter search terms' );

    $args['fields'][] = array( 'type' => 'orderby', 
                                'pre_html' => '<div class="custom-select-search">', 
                                'post_html' => '</div>', 
                               'format' => 'select', 
                               'class' => 'select-css',
                               'values' => array('' => 'Order By','title' => 'Title', 'date' => 'Date Added') );

    $args['fields'][] = array( 'type' => 'order', 
                                'pre_html' => '<div class="custom-select-search">', 
                                'post_html' => '</div>', 
                               'format' => 'select', 
                               'class' => 'select-css',  
                               'values' => array('' => 'Order', 'ASC' => 'Ascending', 'DESC' => 'Descending') );

    $args['fields'][] = array( 'type' => 'reset',
                                'pre_html' => '<div class="custom-select-search">', 
                                'post_html' => '</div>', 
                               'class' => 'button',
                               'value' => 'Reset' );

    register_wpas_form('searchform', $args);
}
add_action('init', 'ajax_search');
require_once('php/aq_resizer.php');

add_action( 'after_setup_theme', 'mhamd_theme_setup' );

function mhamd_theme_setup() {
add_image_size( 'landing', 1400, 1400, array( 'center', 'center' ) );
add_image_size( 'header', 2800, 1100, array( 'center', 'center' ) );
add_image_size( 'callout', 1400, 1000, array( 'center', 'center' ) );
add_image_size( 'resources', 800, 500, array( 'center', 'top' ) );
add_image_size( 'publication', 381, 238, array( 'center', 'top' ) );
};


/**
 * Enqueue styles and scripts
 *
 * @package mhamd
 */
 //ennqueue the proper scripts at the proper times

  
  

    //use external jquery
    if ( ! is_admin() ) {
      wp_deregister_script('jquery');
      wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js", 2.2 , false);
      wp_enqueue_script('jquery');    
    }


add_action( 'wp_enqueue_scripts', 'mhamd__scripts' );


add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars ) {
  // Uncomment to view format of $toolbars

/*print '< pre >';
  print_r($toolbars);
  print '< /pre >';
  die;*/
  


  // Add a new toolbar called "Very Simple"
  // - this toolbar has only 1 row of buttons
 //  $toolbars['Full' ] = array();
 //  $toolbars['Full' ][1] = array('bold', 'classes');

  // Edit the "Full" toolbar and remove 'code'
  // - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
/*
  if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
  {
      unset( $toolbars['Full' ][2][$key] );
  }
  */

  // remove the 'Basic' toolbar completely
 // unset( $toolbars['Basic' ] );

  // return $toolbars - IMPORTANT!
  return $toolbars;
}

function add_style_select_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'add_style_select_buttons' );

//add custom styles to the WordPress editor
function my_custom_styles( $init_array ) {  

    $style_formats = array(  
        // These are the custom styles
        array(  
            'title' => 'Purple Button',  
            'block' => 'span',  
            'classes' => 'btn fill purple',
            'wrapper' => true,
        ),  
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_custom_styles' );

