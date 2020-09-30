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
  $paged = (int) get_query_var('paged');
  $title = get_post_type_object($post_type)->label;
  $class=$post_type;

  if($post_type == 'post'):
		$get_page_id = get_page_by_path("blog");
		$get_page_id = $get_page_id->ID;
    $title = get_the_title( $get_page_id );
    $class="blog";
  endif;
?>
  <main class="l-main-sub <?php echo $class; ?>">
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
// $paged = (int) get_query_var('paged');
          $post_type = 'post';
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
        <div class="p-blog">
          <div class="p-blog-list">
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
                <article class="p-blog-list__item p-article01">
                <div class="p-article01__date p-triangle">
                    <time class="p-date" datetime="<?php echo the_time('Y.m.d'); ?>">
                            <span class="p-date__month"><?php echo the_time('M'); ?></span>
                            <span class="p-date__day"><?php echo the_time('d'); ?></span>
                            <?php echo the_time('Y'); ?></time>
                  </div>

                  <a class="p-article01__img p-hover-effect--type1" href="<?php the_permalink(); ?>">
                  <?php if (has_post_thumbnail()) { ?>
                      <?php the_post_thumbnail('full', array('class' => '')); ?>
                    <?php	} else { ?>
                      <img src="<?php echo get_bloginfo('template_directory'); ?>/dist/img/no-imagethum.png" alt="" />
                    <?php } ?>
                  </a>
                  <div class="p-article01__content">
                    <h3 class="p-article01__title">
                      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a>
                    </h3>
                    <p class="p-article01__cat"><a href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>" rel="category tag"><?php echo esc_html($cat_name); ?></a></p>
                  </div>
                </article>

              <?php endwhile; ?>
          <?php else: ?>
            <p>お知らせする情報はありません。</p>
          <?php endif ?>
        </div>
        </div>

        <div class="p-page-navi">
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?> </div>
        <?php wp_reset_postdata(); ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </main>
  <?php get_footer();