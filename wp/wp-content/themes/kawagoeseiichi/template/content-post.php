<?php 
	$paged = (int) get_query_var('paged');
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


	<div class="l-content_body">
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
			<p>現在、お知らせする記事はございません。</p>
	<?php endif; ?>


		<div class="c-pagenavi u-align_center ">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?>
		</div>
	</div>


