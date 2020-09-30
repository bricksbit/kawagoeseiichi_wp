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
      <div class="hero">
      <?php
echo do_shortcode('[smartslider3 slider="3"]');
?>  
      </div>
      <section class="l-sec">
        <div class="l-container">
          <div class="p-block">
            <div class="p-block__item p-block01">
              <h3 class="title">区議会で行われた活動のレポートを<br>毎月アップ</h3>
              <a href="/report" class="p-block__button">
                <div class="p-block__button--label"><span>区議会レポート</span></div>
              </a>
            </div>
            <div class="p-block__item p-block02">
              <h3 class="title">タウンミーティングの報告やイベントなどの報告</h3>
              <a href="/activity_report" class="p-block__button">
                <div class="p-block__button--label"><span>活動報告</span></div>
              </a>
            </div>
            <div class="p-block__item p-block03">
              <h3 class="title">議会において代表質問、一般質問の内容、答弁を載せています。また、実際のどのようになったかの状況を記載しております。</h3>
              <a href="/activity" class="p-block__button">
                <div class="p-block__button--label"><span>議会活動</span></div>
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
                    <img src="<?php echo get_bloginfo('template_directory'); ?>/dist/img/no-imagethum.png" alt="" />
                  <?php } ?>
                  </div>
                  <div class="p-card-h--text">
                    <time class="p-card-h--date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                    <h3 class="p-card-h--title"><?php the_title(); ?></h3>
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
            <div class="p-activity-list">
              <div class="p-headline01">
                <h2 class="p-headline01__title">Activity<span class="p-headline01__sub">議会活動</span></h2>
              </div>

              <?php
                $paged = (int) get_query_var('paged');
                $args = array(
                    'posts_per_page' => 5,
                    'paged' => $paged,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'activity',
                    'post_status' => 'publish'
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
                  <article class="p-index-content04__col-list-item p-article02">
                    <a href="<?php the_permalink(); ?>">
                      <time class="p-article02__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time>
                      <h3 class="p-article02__title"><?php the_title(); ?></h3>
                    </a>
                  </article>

                <?php
                  endwhile;
                endif;
                wp_reset_postdata();
                ?>
              <p class="p-info__list__btn">
                <a class="p-btn" href="#">議会活動一覧</a>
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
              <div class="p-prof__banner--link"><a class="button" href="/profile">プロフィール</a></div>
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
            <div class="p-report-list">
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
              <article class="p-report-list__item p-article01">

                <a class="p-article01__img p-hover-effect--type1" href="<?php the_field('pdf'); ?>" target="_blank">
                <?php if (has_post_thumbnail()) { ?>
                  
                  <img src="<?php echo the_field('thumnail-top'); ?>" alt="" />
                      <!-- <?php //the_post_thumbnail('full', array('class' => '')); ?> -->
                    <?php	} else { ?>
                      <img src="<?php echo get_bloginfo('template_directory'); ?>/dist/img/no-imagethum.png" alt="" />
                    <?php } ?>

              </a>
                <div class="p-article01__content">
                  <time class="p-article01__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                  <h3 class="p-article01__title">
                    <a href="<?php the_field('pdf'); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                  </h3>
                </div>
              </article>
              <?php
                endwhile;
              ?>
              <?php
                endif;
                wp_reset_postdata();
              ?>
              <p class="p-report-list__btn">
                <a class="p-btn" href="/report">レポート一覧</a>
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
            <div class="p-blog-list">
            <?php
									$args = array(
										'posts_per_page' => 4,
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
                <article class="p-blog-list__item p-article01">
                  <div class="p-article01__date p-triangle">
                    <time class="p-date" datetime="<?php echo the_time('Y.m.d'); ?>">
                            <span class="p-date__month"><?php echo get_the_date(M); ?></span>
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
              <?php
                endwhile;
              ?>
              <?php
                endif;
                wp_reset_postdata();
              ?>

              <p class="p-blog-list__btn">
                <a class="p-btn" href="/blog">ブログ一覧</a>
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php get_footer();?>