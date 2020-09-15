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
        <!-- <ul>
          <li class="home">ホーム</li>
          <li>パンくず</li>
        </ul> -->
      </div>
    </div>
    <div class="l-content-wrap">
      <div class="l-content">
      <?php if (is_page('idea') || is_page('profile') || is_page('policy') || is_page('contact') || is_page('privacy')): ?>
        <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile;?>
        <?php endif; ?>
      <?php elseif (is_page('all-news')): ?>
        <?php get_template_part( 'template/content', 'custom' ); ?>
      <?php elseif (is_page('activities')): ?>
        <?php get_template_part( 'template/content', 'activities' ); ?>
      <?php elseif (is_page('activity-reports')): ?>
        <?php get_template_part( 'template/content', 'activity-reports' ); ?>
      <?php endif; ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </main>

  <?php get_footer();
