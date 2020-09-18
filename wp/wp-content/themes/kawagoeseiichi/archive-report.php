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
          $args = array(
            'posts_per_page' => 12,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'report',
            'post_status' => 'publish'
          );
          $the_query = new WP_Query($args);
        ?>
        <div class="p-blog">
          <div class="p-blog__list">
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
              <article class="p-card-v">
                <header class="p-card-v__header">
                  <p class="p-triangle-g">
                    <span class="p-triangle__inner">No.50</span>
                  </p>
                  <a href="<?php the_permalink(); ?>" class="p-card-v--img p-hover-effect--type1">
                  <?php if (has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail('full', array('class' => '')); ?>
                  <?php	} else { ?>
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-image_blogthum.png" alt="" />
                    <!-- <img src="https://picsum.photos/g/800/494"> -->
                  <?php } ?>
                  </a>
                </header>
                <h3 class="p-card-v__title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
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