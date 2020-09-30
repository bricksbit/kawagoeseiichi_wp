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
    $post_type = get_post_type_query();
    $class=$post_type;
  
?>
  <main class="l-main-sub <?php echo $post_type; ?>">
    <div class="hero-sub"></div>

    <h3 id="page_header_title">
      <div class="l-container">ブログの検索結果<span>（<?php echo $total_results; ?>件）</span></div>
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
          <?php
                if( $total_results > 0 ):
                  if(have_posts()):
                    while(have_posts()): the_post();
              ?>
          <article class="p-blog-v p-blog-top__list--item">
              <header class="p-blog-v__header">
                <p class="p-triangle-g">
                  <span class="p-triangle__inner">片平 愛さん<br>20代</span>
                </p>
                <a class="p-blog-v--img p-hover-effect--type1" href="<?php the_permalink(); ?>">
                  <img src="http://placehold.jp/0c9e9e/ffffff/740x512.png" class="p-card-h--img" alt=""></a>
              </header>
              <h3 class="p-blog-v__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <p class="p-article01__cat"><a href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>" rel="category tag"><?php echo esc_html($cat_name); ?></a></p>
              </h3>
            </article>
                      <!-- <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                      <?php the_excerpt(); ?> -->
                    <?php endwhile; ?>
                  <?php endif; ?>
              <?php  else: ?>
                <?php echo $search_query; ?> に一致する情報は見つかりませんでした。
              <?php endif; ?>

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


