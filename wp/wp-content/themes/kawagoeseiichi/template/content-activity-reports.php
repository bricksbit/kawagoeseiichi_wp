<?php 
	$paged = (int) get_query_var('paged');
	$post_type = 'activity-report';
	$args = array(
		'posts_per_page' => 8,
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
  <?php
    endwhile;
    ?>
    <?php the_posts_navigation( array( 'prev_text' => '前へ', 'next_text' => '次へ' ) ); ?>
    <?php
  else:
  ?>
    <p>現在、お知らせする情報はありません。</p>
<?php
  
  endif
  
  ?>
    <!-- <?php //wp_reset_postdata(); ?> -->
</div>
