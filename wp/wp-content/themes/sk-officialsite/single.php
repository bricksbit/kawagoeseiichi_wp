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
  <main class="l-main-sub <?php echo $class; ?>">
    <div class="hero-sub">
    </div>

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
      <?php 

      if($post_type === 'post'): ?>
        <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile;?>
        <?php endif; ?>
      <?php elseif( $post_type === 'news'): ?>
      <?php elseif( $post_type === 'activity_report'): ?>
        <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
            <div id="article" class="report">
              <div class="u-post_content">
                <?php the_content(); ?>
              </div>
            </div>
          <?php endwhile;?>
        <?php endif; ?>
      <?php elseif( $post_type === 'activity'): ?>
        <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
              <div class="p-qa-agenda">
            <?php the_content(); ?>
            </div>
            <div class="p-qa">
            <?php
              $group_set = SCF::get( 'qa' );
              foreach ( $group_set as $field_name => $field_value ) {
            ?>
              <h4 class="p-headline03-g"><?php echo nl2br(esc_html( $field_value['speaker'] )); ?></h4>
              <p class="p-qa-question"><?php echo nl2br(esc_html( $field_value['question'] )); ?></p>
              <h4 class="p-headline03-o"><?php echo nl2br(esc_html( $field_value['answerer'] )); ?></h4>
              <p class="p-qa-answer"><?php echo nl2br(esc_html( $field_value['answer'] )); ?></p>
            <?php } ?>

            </div>
          <?php endwhile;?>
        <?php endif; ?>
      <?php endif; ?>
      

      </div>
      <?php get_sidebar(); ?>
    </div>
  </main>

  <?php get_footer();
