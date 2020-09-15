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
?>
    <main class=l-main>
      <div class="hero"><img src="https://placehold.jp/1920x1080.png" alt="" width="100%" height="auto"></div>
      <section class="l-sec">
        <div class="l-container">
          <div class="p-cards">
            <div class="p-card">
              <img src="http://placehold.jp/1d960e/ffffff/360x270.png" alt="Sample photo" width="100%" height="auto">
              <a href="#" class="p-card__button">
                <div class="p-card__button--label"><span>活動報告</span></div>
              </a>
            </div>
            <div class="p-card">
              <img src="http://placehold.jp/1d960e/ffffff/360x270.png" alt="Sample photo" width="100%" height="auto">
              <a href="#" class="p-card__button">
                <div class="p-card__button--label"><span>活動報告</span></div>
              </a>
            </div>
            <div class="p-card">
              <img src="http://placehold.jp/1d960e/ffffff/360x270.png" alt="Sample photo" width="100%" height="auto">
              <a href="#" class="p-card__button">
                <div class="p-card__button--label"><span>活動報告</span></div>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section class="l-sec l-sec-gray">
        <div class="l-container">
          <div class="p-info">
            <div class="p-info__list">
              <div class="p-headline01">
                <h2 class="p-headline01__title">News<span class="p-headline01__sub">お知らせ</span></h2>
              </div>
              <?php

                $paged = (int) get_query_var('paged');
                $args = array(
                    'posts_per_page' => 3,
                    'paged' => $paged,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'news',
                    'post_status' => 'publish',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'news-cat',
                        'field'    => 'slug',
                        'terms'    => 'info',
                      ),
                    )
                );
                $the_query = new WP_Query($args);
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    $taxonomies = get_the_taxonomies();

                    if ($taxonomies):
                      $taxonomy = key( $taxonomies );
                      $terms  = get_the_terms( get_the_ID(),$taxonomy );
                      $term_url = esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
                      $term_name  = esc_html($terms[0]->name);
                    endif;

              ?>
              <article class="p-card-h">
                <a class="p-card-h--inner" href="<?php the_permalink(); ?>" title="<?php the_permalink(); ?>">
                  <div class="p-card-h--img">
                  <?php if (has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail('full', array('class' => '')); ?>
                  <?php	} else { ?>
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-imagethum.png" alt="" />
                  <?php } ?>
                  </div>
                  <div class="p-card-h--text">
                    <h3 class="p-card-h--title"><?php the_title(); ?></h3>
                    <time class="p-card-h--date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                  </div>
                </a>
              </article>
              <?php
                endwhile;
              endif;
              wp_reset_postdata();
              ?>
              <p class="p-info__list__btn">
                <a class="p-btn" href="#">おしらせ一覧</a>
              </p>
            </div>
            <div class="p-info__list">
              <div class="p-headline01">
                <h2 class="p-headline01__title">Event<span class="p-headline01__sub">イベント</span></h2>
              </div>
              <?php
                $paged = (int) get_query_var('paged');
                $args = array(
                    'posts_per_page' => 3,
                    'paged' => $paged,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'news',
                    'post_status' => 'publish',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'news-cat',
                        'field'    => 'slug',
                        'terms'    => 'event',
                      ),
                    )
                );
                $the_query = new WP_Query($args);
                if ( $the_query->have_posts() ) :
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    $taxonomies = get_the_taxonomies();

                    if ($taxonomies):
                      $taxonomy = key( $taxonomies );
                      $terms  = get_the_terms( get_the_ID(),$taxonomy );
                      $term_url = esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
                      $term_name  = esc_html($terms[0]->name);
                    endif;

                ?>
                <article class="p-card-h">
                  <a class="p-card-h--inner" href="<?php the_permalink(); ?>">
                    <div class="p-card-h--img">
                    <?php if (has_post_thumbnail()) { ?>
                      <!-- <?php the_post_thumbnail('full', array('class' => '')); ?> -->
                      <img src="http://placehold.jp/0c9e9e/ffffff/214x132.png" alt="">
                    <?php	} else { ?>
                      <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-imagethum.png" alt="" />
                      <!-- <img src="https://picsum.photos/g/800/494"> -->
                    <?php } ?>
                    </div>
                    <div class="p-card-h--text">
                      <h3 class="p-card-h--title"><?php the_title(); ?></h3>
                      <time class="p-card-h--date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                    </div>
                  </a>
                </article>
                <?php
                  endwhile;
                endif;
                wp_reset_postdata();
                ?>
              <p class="p-info__list__btn">
                <a class="p-btn" href="#">イベント一覧</a>
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="l-sec">
        <div class="l-container">
          <div class="p-prof">
            <div class="p-prof__banner">
              <div class="p-prof__banner--img"><img src="dist/img/img_prof-sp.jpg" alt=""></div>
              <div class="p-prof__banner--text">
                <h3>葛飾の明日を育てる</h3>
                <p>気がついた人が動かなければ変わらないということ</p>
                <p>賛成反対だけではなく行政などの仕組みを知り、対案を提案していくことの大切さ</p>
                <p>人と人とのつながりが力を産み、新しい発想や行動力になること</p>
                <p>一度要請してあきらめるのではなく、あきらめの悪さ、言い換えれば粘り強く続けなければならない</p>
              </div>
              <div class="p-prof__banner--link"><a class="button" href="#">プロフィール</a></div>
            </div>
          </div>
        </div>
      </section>
      <section class="l-sec l-sec-gray">
        <div class="l-container">
          <div class="p-report">
            <div class="p-headline01">
              <h2 class="p-headline01__title">Report<span class="p-headline01__sub">レポート</span></h2>
            </div>
            <div class="p-report__list">
            <?php
									$args = array(
										'posts_per_page' => 3,
										'orderby' => 'post_date',
										'order' => 'DESC',
										'post_type' => 'report',
										'post_status' => 'publish'
									);
									$the_query = new WP_Query($args);
									if ( $the_query->have_posts() ) :
										while ( $the_query->have_posts() ) : $the_query->the_post();
                ?>
              <article class="p-card-v">
                <header class="p-card-v__header">
                  <p class="p-triangle-g">
                    <span class="p-triangle__inner">No.50<br><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time></span>
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
              <?php
                endwhile;
              ?>
              <?php
                endif;
                wp_reset_postdata();
              ?>
              <p class="p-report__list__btn">
                <a class="p-btn" href="http://localhost:8080/report">レポート一覧</a>
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="l-sec">
        <div class="l-container">
          <div class="p-blog-top">
            <div class="p-headline01">
              <h2 class="p-headline01__title">Blog<span class="p-headline01__sub">ブログ</span></h2>
            </div>
            <div class="p-blog-top__list">
            <?php
									$args = array(
										'posts_per_page' => 8,
										'orderby' => 'post_date',
										'order' => 'DESC',
										'post_type' => 'post',
										'post_status' => 'publish'
									);
									$the_query = new WP_Query($args);
									if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                      $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
                      if ( $category && ! is_wp_error($category) ) {
                        foreach ( $category as $cat ) :
                          $cat_name = $cat->name;
                          $cat_id = $cat->term_id;
                          break;
                        endforeach;
                      };
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
              <?php
                endwhile;
              ?>
              <?php
                endif;
                wp_reset_postdata();
              ?>

              <p class="p-blog__list__btn">
                <a class="p-btn" href="http://localhost:8080/blog/">ブログ一覧</a>
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php get_footer();?>