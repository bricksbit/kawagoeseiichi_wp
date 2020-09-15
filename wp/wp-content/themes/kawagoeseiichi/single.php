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


$post_type = get_post_type_query();
if($post_type === 'post'):
  $get_page_id = get_page_by_path("blog");
  $get_page_id = $get_page_id->ID;
  $title = get_the_title( $get_page_id );
  $class="blog";
else:
  $q = $wp_query->query_vars;
  $postTypeNameObj = $q["post_type"];

  $post_type = get_post_type();
  $postTypeName = get_post_type_object($postTypeNameObj)->labels->name;
  $title = $postTypeName;
  $class=$post_type;
  
endif;

?>
  <main class="l-main-sub">
    <div class="hero-sub"><img src="http://placehold.jp/0c9e9e/ffffff/1920x560.png" alt=""></div>

    <h3 id="page_header_title">
      <div class="l-container"><?php the_title(); ?></div>
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
        <?php if ( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile;?>
          <?php endif; ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </main>

  <?php get_footer();
