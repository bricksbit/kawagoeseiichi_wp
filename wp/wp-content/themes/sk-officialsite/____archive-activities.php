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


  $title = get_post_type_object($post_type)->label;
  $class=$post_type;
?>
  <main class="l-main-sub">
    <div class="hero-sub"><img src="http://placehold.jp/0c9e9e/ffffff/1920x560.png" alt=""></div>

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
          $post_type = 'activity_report';
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
          <article class="p-card-h">
            <div class="p-card-h--inner" href="#">
              <div class="p-card-h--img">
                <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) { ?>
                  <?php the_post_thumbnail('full', array('class' => '')); ?>
                <?php	} else { ?>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-imagethum.png" alt="" />
                <?php } ?>
                </a>
              </div>
              <div class="p-card-h--text">
                <h3 class="p-card-h--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="p-card-h__cat">
                  <a href="<?php echo $term_url; ?>"><?php echo $term_name; ?></a>
                </p>
                <time class="p-card-h--date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
              </div>
            </div>
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