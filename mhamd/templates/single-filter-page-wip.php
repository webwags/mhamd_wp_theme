<?php 

$cat_id = get_field('list_category_type');
$ctTermID = get_field('list_page_type');
$ctTerm = get_term( $ctTermID, 'content_type' );
$grid_type = $ctTerm->slug;
$ctTerm = 'content_type_' . $ctTermID;
$content_type_template = get_field('content_type_template', $ctTerm);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

switch( $grid_type ) {
    case 'event':
    $grid = new WP_Advanced_Search('publicaitonGrid');
    break;
    case 'post':
    $grid = new WP_Advanced_Search('newsGrid');
    break;
    case 'publication':
    $grid = new WP_Advanced_Search('publicaitonGrid');
    break;
    default :
    $grid = new WP_Advanced_Search('publicaitonGrid');
    break;

    };
get_header();
?>
<main id="content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="header">
    <div class="featured static" style="background-image: url(<?php the_field('background_image'); ?>)">
        <div class="container">
            <div class="content">
                <h1 class="entry-title"><?php the_title(); ?></h1>
              <?php if( get_field('subtitle')): ?>
                <h3><?php the_field('subtitle'); ?></h3>
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    <?php projectMenu(); ?>
    <?php  $link = 'Edit Filter Page';
    edit_post_link($link); ?>
<div class="entry-content">
<?php if( (get_field('content_title')) || (get_field('content_copy')) ): ?>
<div class="general-content white-bg">
        <div class="container">
             <?php if( get_field('content_title')): ?>
        <div class="headline centered"><div class="dash"></div><h2><?php the_field('content_title'); ?></h2><div class="dash"></div></div>
            <?php endif; ?>
        
            <?php the_field('content_copy'); ?>
<?php if(get_field('list_of_publicaitons')): ?>
<a target="_blank" href="<?php print get_field('list_of_publicaitons');?>" class="btn border purple">Download Publication List</a>
 <?php endif; ?>
                    
<?php endif; ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>
</article>

<div class="filter-block">
      <div class="form-line clearfix">
      <?php $grid->the_form(); ?>
   </div>
 </div>

   <div class="search-results">
         <div id="wpas-results"></div> <!-- This is where our results will be loaded -->
   </div>

<?php 
$full_page_callout = get_field('full_page_callouts');
if($full_page_callout){
$postID =  $full_page_callout['full_page_callout'];
$term_obj_full = get_the_terms( $postID, 'callout_type' );
$callout_type = join(', ', wp_list_pluck($term_obj_full, 'slug'));
}
?>

<?php getCalloutTemplate( $callout_type); ?>
</main>
<?php 
get_footer();
?>