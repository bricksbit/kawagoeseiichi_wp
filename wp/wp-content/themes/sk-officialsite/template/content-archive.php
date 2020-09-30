<?php

	$paged = (int) get_query_var('paged');

	$post_type = get_post_type_query();
	$term = get_current_term();
	$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
	$cat = get_the_category();
	$cat = $cat[0];
	$cat_slug = $cat->slug;

	if( is_post_type_archive( 'post' ) ):
		$args = array(
			'posts_per_page' => 5,
			'paged' => $paged,
			'orderby' => 'post_date',
//			'order' => 'ASC',
			'post_type' => $post_type,
			'slug' => $cat_slug
		);
	else:
		if (is_post_type_archive() ):
				$args = array(
					'posts_per_page' => 12,
					'paged' => $paged,
					'post_type' => $post_type,
					'orderby' => 'post_date'
//					'order' => 'ASC'
				);
		else:
			$args=array(
				'tax_query' => array(
					array(
						'taxonomy' => $term->taxonomy,
						'field' => 'slug',
						'terms' => $term->slug
					),
				),
				'paged' => $paged,
				'posts_per_page'=> 12,
				'orderby' => 'post_date'
//				'order' => 'ASC'
			);
		endif;
	endif;
	$the_query = new WP_Query($args);

?>

<?php if ($post_type === 'report'): ?>
	<?php if($the_query->have_posts()): ?>
		<div class="p-article p-info__list">
		<?php while($the_query->have_posts()) : $the_query->the_post(); ?>

				<div class="col-6 col-md-3">
				<div class="c-card">
					<a href="<?php the_field('pdf'); ?>" title="<?php the_title(); ?>" target="_blank" class="c-card_inner">
						<div class="c-card_media">
							<div class="c-card_media-inner">
						<?php if (has_post_thumbnail()) { ?>
							<?php the_post_thumbnail('full', array('class' => '')); ?>
						<?php	} else { ?>
							<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-image_blogthum.png" alt="" />
							<!-- <img src="https://picsum.photos/g/800/494"> -->
						<?php } ?>

							</div>
						</div>
						<h3 class="c-card_title"><?php the_title(); ?></h3>
					</a>
				</div>
			</div>

			<?php endwhile; ?>
			</div>
		<?php else: ?>
			<p>現在、お知らせする記事はございません。</p>

	<?php endif; ?>
<?php elseif($post_type === 'activity-report'): ?>
	<div class="p-article p-info__list">
	<?php if($the_query->have_posts()): ?>
		<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
		<?php
				$taxonomies = get_the_taxonomies();

				if ($taxonomies):
					$taxonomy = key( $taxonomies );
					$terms  = get_the_terms( get_the_ID(),$taxonomy );
					$term_url = esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
					$term_name  = esc_html($terms[0]->name);
				endif;
			?>
			<article class="p-card-h">
				<div class="p-card-h--inner" href="#">
					<div class="p-card-h--img">
						<a href="<?php the_permalink(); ?>" class="p-card-h--link">
							<img src="http://placehold.jp/0c9e9e/ffffff/214x132.png" alt="">
						</a>
					</div>
					<div class="p-card-h--text">
						<h3 class="p-card-h--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="p-card-h__cat">
							<a href="<?php ?>">タウンミーティング・テーマ別学習会</a>
						</p>
						<time class="p-card-h--date" datetime="2020.03.24">2020.03.24</time>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	<?php else: ?>
		<p>現在、お知らせする記事はございません。</p>
	<?php endif; ?>
	</div>
	<?php else: ?>
	<?php if($the_query->have_posts()): ?>
	<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
	<?php
		$taxonomies = get_the_taxonomies();

		if ($taxonomies):
			$taxonomy = key( $taxonomies );
			$terms  = get_the_terms( get_the_ID(),$taxonomy );
			$term_url	= esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
			$term_name	= esc_html($terms[0]->name);
		endif;
	?>
			<article class="p-blog-v p-blog__list--item">
				<header class="p-blog-v__header">
					<p class="p-triangle-g">
						<span class="p-triangle__inner">片平 愛さん<br>20代</span>
					</p>
					<a href="<?php the_permalink(); ?>" class="p-blog-v--img p-hover-effect--type1">
						<?php if (has_post_thumbnail()) { ?>
							<?php the_post_thumbnail('full', array('class' => '')); ?>
						<?php	} else { ?>
							<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-imagethum.png" alt=""  class="p-card-h--img" />
							<!-- <img src="https://picsum.photos/g/800/494"> -->
						<?php } ?>
					</a>
				</header>
				<h3 class="p-blog-v__title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="p-article01__cat"><a href="https://demo.tcd-theme.com/tcd063/category/staff/" rel="category tag">$term_name</a></p>
				</h3>
			</article>


				<article class="c-cardhorizontal">
					<a href="<?php the_permalink(); ?>" class="c-cardhorizontal_inner" title="<?php the_permalink(); ?>">
						<div class="c-cardhorizontal_media">
						<?php if (has_post_thumbnail()) { ?>
							<?php the_post_thumbnail('full', array('class' => '')); ?>
							<!-- <img src="https://picsum.photos/g/800/494"> -->
						<?php	} else { ?>
							<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-imagethum.png" alt="" />
							<!-- <img src="https://picsum.photos/g/800/494"> -->
						<?php } ?>
						</div>
						<div class="c-cardhorizontal_content">
							<div class="c-cardhorizontal_time">
								<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
							</div>
							<p class="c-cardhorizontal_title"><?php the_title(); ?></p>
						</div>
					</a>
				</article>

		<?php endwhile; ?>
	<?php else: ?>
			<p>お知らせする記事はございまん。</p>

	<?php endif; ?>
<?php endif ?>
<div class="p-page-navi">
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?>	
	<!-- <ul class="p-page-navi--numbers">
		<li><span aria-current="page" class="p-page-navi--numbers current">1</span></li>
		<li><a class="p-page-navi--numbers" href="https://demo.tcd-theme.com/tcd059/blog/page/2/">2</a></li>
		<li><a class="next p-page-navi--numbers" href="https://demo.tcd-theme.com/tcd059/blog/page/2/"><span>»</span></a></li>
	</ul> -->
</div>
<?php wp_reset_postdata(); ?>


<!-- <div class="c-pagenavi u-align_center ">
	<?php //if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?>
</div> -->
<!-- <?php wp_reset_postdata(); ?> -->

