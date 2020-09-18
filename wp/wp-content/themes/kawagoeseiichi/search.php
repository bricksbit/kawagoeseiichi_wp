<?php
/**
 * The front page template file
 * *
 * @package WordPress
 * @subpackage kawagoe
 * @since 1.0
 * @version 1.0
 */

get_header();

    global $wp_query;
    $total_results = $wp_query->found_posts;
    $search_query = get_search_query();

    $paged = (int) get_query_var('paged');
    $title = get_post_type_object($post_type)->label;
    $post_type = get_post_type();
    $class=$post_type;
  
?>
  <main class="l-main-sub">
    <div class="hero-sub"></div>

    <h3 id="page_header_title">
      <div class="l-container"><?php echo $title; ?></div>
    </h3>
    <div id="bread_crumb">
      <div class="l-container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
          <?php if(function_exists('bcn_display'))
          {
          bcn_display();
          }?>
        </div>
      </div>
    </div>
    <div class="l-content-wrap">
      <div class="l-content">
        <div class="p-blog">
          <div class="p-blog__list">

          </div>
        </div>

        <!-- <div class="p-page-navi">
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?> </div>
        <?php wp_reset_postdata(); ?> -->
      </div>
      <?php get_sidebar(); ?>
    </div>
  </main>




  

  <?php get_footer();


