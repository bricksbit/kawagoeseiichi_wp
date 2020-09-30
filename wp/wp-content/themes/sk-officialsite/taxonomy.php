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

$paged = (int) get_query_var('paged');
// $cat = get_the_category();
//   $cat = $cat[0];
//   $cat_name = $cat->name;
//   $cat_id   = $cat->cat_ID;
//   $cat_slug = $cat->slug;
//   $parent_id = $cat->category_parent;

  $post_type = get_post_type();
	// if($post_type == 'post'):
	// 	$get_page_id = get_page_by_path("blog");
	// 	$get_page_id = $get_page_id->ID;
  //   $title = get_the_title( $get_page_id );
  //   $class="blog";
  // elseif($post_type === 'report' || $post_type === 'committee' || $post_type === 'meeting'):
  //   $title = get_post_type_object($post_type)->label;
  //   $class=$post_type;
  // else:
    $title = get_post_type_object( get_post_type() )->label;
    $taxonomy_slug = get_query_var('post_type');
    $post_type = get_post_type();
    $class=$post_type;
	// endif;
?>

  <main class="l-main-sub <?php echo $post_type; ?>">
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
        <?php 
          // $post_type = 'activity';
          $args = array(
            'posts_per_page' => 12,
            'paged' => $paged,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => $post_type,
            'post_status' => 'publish'
          );

          $the_query = new WP_Query($args);
        ?>
        <div class="p-article p-info__list">
        <?php 
          if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) : $the_query->the_post();
            $taxonomies = get_the_taxonomies();

            if ($taxonomies):
              $taxonomy = key( $taxonomies );
              $terms  = get_the_terms( get_the_ID(),$taxonomy );
              $term_url	= esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
              $term_name	= esc_html($terms[0]->name);
            endif;
        ?>
          <article class="p-news-list__item p-article04">
            <header class="p-article04__header">
                <p class="p-card-h__cat">
                  <a href="<?php echo $term_url; ?>"><?php echo $term_name; ?></a>
                </p>
                <h2 class="p-article04__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
            </header>
            <p class="p-article04__excerpt"><?php the_excerpt(); ?></p>
          </article>
          <?php endwhile; ?>
          <?php else: ?>
            <p>お知らせする情報はありません。</p>
          <?php endif ?>
        </div>
        <div class="p-page-navi">
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?> </div>
        <?php wp_reset_postdata(); ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </main>
  <?php get_footer();