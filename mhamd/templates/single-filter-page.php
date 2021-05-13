<?php
/*
Template Name: Filter Page
Template Post Type: page
*/
get_header();
?>
<script type='text/javascript'> 
$(document).ready(function(){
  $('#tag').change(function(){
    // Call submit() method on form
    $('#filter').submit();
  });
});
</script>

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
<?php projectMenu(); ?>
<?php
$link = 'Edit Filter Page';
edit_post_link( $link );
?>
<div class="entry-content">
<?php if( (get_field('content_title')) || (get_field('content_copy')) ): ?>
<div class="general-content white-bg">
<div class="container">
  <?php if( get_field('content_title')): ?>
  <div class="headline centered">
    <div class="dash"></div>
    <h2>
      <?php the_field('content_title'); ?>
    </h2>
    <div class="dash"></div>
  </div>
  <?php endif; ?>
  <?php the_field('content_copy'); ?>
  <?php if(get_field('list_of_publicaitons')): ?>
  <a target="_blank" href="<?php print get_field('list_of_publicaitons');?>" class="btn border purple">Download Publication List</a>
  <?php endif; ?>
  <?php endif; ?>
  <div class="entry-links">
    <?php wp_link_pages(); ?>
  </div>
</div>
</article>
<?php
//print the_field('list_page_type') . ' <br>';
$cat_id = get_field( 'list_category_type' );
$ctTermID = get_field( 'list_page_type' );
$ctTerm = get_term( $ctTermID, 'content_type' );
$grid_type = $ctTerm->slug;
$ctTerm = 'content_type_' . $ctTermID;
$content_type_template = get_field( 'content_type_template', $ctTerm );
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$today = current_time( 'Ymd' );

$args = array();

if ( $_GET[ "category" ] !== "" ) {

  $cat_id = $_GET[ "category" ];

} else {

  $cat_id = 1;

}
if ( $_GET[ "tag" ] !== "" ) {

  $tag_id = $_GET[ "tag" ];

}
if ( $_GET[ "posttype" ] !== "" ) {

  $posttype_id = $_GET[ "posttype" ];

}
if ( $_GET[ "eventtype" ] !== "" ) {

  $eventtype_id = $_GET[ "eventtype" ];

}
if ( $_GET[ "term" ] !== "" ) {

  $search_id = $_GET[ "term" ];

}
if ( $_GET[ "language" ] !== "" ) {

  $language_id = $_GET[ "language" ];

}

switch ( $grid_type ) {
  case 'event':
    $meta_key = 'event_type';
    $meta_value = $eventtype_id;
    break;
  case 'post':
    $orderby = 'date';
    $order = 'DESC';
    $meta_key = 'post_type';
    $meta_value = $posttype_id;

    break;
  case 'publication':
    $orderby = 'title';
    $order = 'ASC';
    if ( $language_id == 'en_publication' ) {
      $meta_key = 'en_publication';
    } elseif ( $language_id == 'es_publication' ) {
      $meta_key = 'es_publication';
    };
    break;
  default:
    $orderby = 'title';
    $order = 'ASC';
    break;

};

$args += array(
  'post_type' => array( $grid_type ),
  'cat' => array( $cat_id ),
  'post_status' => array( 'publish' ),
  'nopaging' => false,
  'posts_per_page' => 9,
  'paged' => $paged
);

if ( $search_id != '' ) {
  add_filter( 'posts_where', 'title_filter', 10, 2 );
  $args += array(
    'title_filter' => $search_id,
    'title_filter_relation' => 'LIKE'
  );
};

if ( $eventtype_id ) {
  $args += array(
    'meta_key' => $meta_key,
    'meta_value' => $meta_value,
    'meta_compare' => 'LIKE'
  );
};

if ( $language_id ) {
  $args += array(
    'meta_key' => $meta_key,
    'meta_value' => ' ',
    'meta_compare' => '!=',

  );
}

if ( $posttype_id ) {
  $args += array(
    'meta_key' => $meta_key,
    'meta_value' => $meta_value
  );
}

if ( $tag_id ) {
  $args += array(
    'tag_id' => $tag_id
  );
};

/*
Categories blocked
    Advocacy - 124
    Bill Lists - 282
    Consumer Quality Team - 119
    Legislative Wrap-Ups - 283
    Parity Law - 61


*/
if ( $grid_type == 'event' ) {
  $args += array(
    'order' => 'ASC',
    'orderby' => 'event_start_day_date',
    'post_type' => $grid_type,
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'event_start_day_date',
        'value' => $today,
        'compare' => '>=',
      ),
      array(
        'key' => 'event_end_day_date',
        'value' => $today,
        'compare' => '>=',
      ),
    ),
  );
} elseif ( $grid_type == 'publication' ) {
  $args += array(
    'category__not_in' => array( 124, 119, 61, 283, 282 ),
    'orderby' => $orderby,
    'order' => $order,
    'post_type' => $grid_type

  );

} elseif ( $grid_type == 'post' ) {
  $args += array(
    'cat' => array( 0 ),
    'orderby' => $orderby,
    'order' => $order,
    'post_type' => $grid_type,
  );

} else {
  $args += array(
    'orderby' => $orderby,
    'order' => $order,
    'post_type' => $grid_type
  );
}

$wpex_query = new WP_Query( $args );
/* 
print "<pre>";
print_r($args);
print "</pre>";
print $wpex_query->found_posts . '<br>';
print $today;
*/
global $wpex_query;
?>
<div class="filter-block">
  <pre>
  <?php
  print_r( $args );
  ?>
</pre>
  <form id="filter" method="get">
    <div class="form-line clearfix">
      <?php if( $grid_type == "publication" ): ?>
      <div class="form-item-contain filter">
        <div class="custom-select">
          <select name="category" id="category">
            <option value="">Filter by Age Group</option>
            <option value="1">All Age Groups</option>
            <option value="2">Children &amp; Youth 0-24 years</option>
            <option value="3">Adults 25-64 years</option>
            <option value="4">Older Adults 65+</option>
            <option value="5">Healthy New Moms</option>
          </select>
        </div>
      </div>
      <?php endif; ?>
      <?php if( $grid_type == "event" ): ?>
      <div class="form-item-contain filter">
        <div class="custom-select">
          <select name="category" id="category">
            <!--
             <option value="">Filter by Age Group</option>
              <option value="1">All Age Groups</option>
              <option value="2">Children &amp; Youth 0-24 years</option>
              <option value="3">Adults 25-64 years</option>
              <option value="4">Older Adults 65+</option>
              <option value="5">Healthy New Moms</option> 
            -->
            <option value="">Filter by Category</option>
            <option value="1">All Events</option>
            <option value="124">Advocacy</option>
            <option value="121">Mental Health First Aid</option>
            <option value="294">Older Adults Vibrant Minds</option>
            <option value="5">Healthy New Moms</option>
          </select>
        </div>
      </div>
      <?php endif; ?>
      <?php if( $grid_type == "post"): ?>
      <div class="form-item-contain filter">
        <div class="custom-select">
          <select name="tag" id="tag">
            <option value="">Filter by Tag</option>
            <option value="135">Advocacy & Public Policy</option>
            <option value="114">Community Education &amp; Training</option>
            <option value="115">Community Engagement</option>
            <option value="130">Maryland Parity</option>
            <option value="117">Services Oversight</option>
            <option value="118">Uncategorized</option>
          </select>
        </div>
      </div>
      <?php endif; ?>
      <?php if( $grid_type == "publication"): ?>
      <div class="form-item-contain filter">
        <div class="custom-select">
          <select name="language" id="language">
            <option value="">Filter by Language</option>
            <option value="en_publication">English</option>
            <option value="es_publication">Spanish</option>
          </select>
        </div>
      </div>
      <?php endif; ?>
      <?php if( $grid_type == "event"): ?>
      <div class="form-item-contain filter">
        <div class="custom-select">
          <select name="eventtype" id="eventtype">
            <option value="">Filter by Type</option>
            <option value="event">Event</option>
            <option value="training">Training</option>
          </select>
        </div>
      </div>
      <?php endif; ?>
      <?php if( $grid_type == "post"): ?>
      <div class="form-item-contain filter">
        <div class="custom-select">
          <select name="posttype" id="posttype">
            <option value="">Filter by Type</option>
            <option value="news">News</option>
            <option value="blog">Blog</option>
          </select>
        </div>
      </div>
      <?php endif; ?>
      <div class="form-item-contain search">
        <input class="form-item" type="text" name="term" placeholder="Search" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'">
      </div>
      <div class="form-button-contain">
        <input class="hide" type="submit" value="submit"  name="submit" />
      </div>
      <div class="form-button-contain"> <a class="btn fill purple" href="<?php echo esc_attr( get_permalink( )); ?>" class="adverts-button-small">Reset</a> </div>
    </div>
  </form>
</div>
<?php
if ( !( $wpex_query->have_posts() ) ) {

  print '<div class="listing-block white-bg">
    <div class="container"><h2 style="text-align: center;">Please Try Again</2><p> No results found.</p></div></div>';

} else {


  getGridTemplate( $grid_type );

}
?>
<?php wp_reset_postdata(); // reset the query ?>
<?php wpex_pagination(); ?>
<?php wp_reset_postdata(); // reset the query ?>
<?php
$full_page_callout = get_field( 'full_page_callouts' );
if ( $full_page_callout ) {
  $postID = $full_page_callout[ 'full_page_callout' ];
  $term_obj_full = get_the_terms( $postID, 'callout_type' );
  $callout_type = join( ', ', wp_list_pluck( $term_obj_full, 'slug' ) );
}
?>
<?php getCalloutTemplate( $callout_type); ?>
</main>
<?php
get_footer();
?>
