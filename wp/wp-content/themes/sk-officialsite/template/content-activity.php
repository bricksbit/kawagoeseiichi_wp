<?php 
	$paged = (int) get_query_var('paged');
	$post_type = 'activity';
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


<div class="l-content_main">
	<div class="l-content_header">
		<h2 class="l-content_header-title">代表・一般質問</h2>
	</div>
	<div class="l-content_body">
		<div class="l-content_body-text">
			<p>議会において代表質問、一般質問の内容、答弁を載せています。また、実際のどのようになったかの状況を記載しております。</p>
			<?php if ( $the_query->have_posts() ) : ?>
			<ul class="c-list c-list-unstyled">
				<?php 
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$taxonomies = get_the_taxonomies();

						if ($taxonomies):
							$taxonomy = key( $taxonomies );
							$terms  = get_the_terms( get_the_ID(),$taxonomy );
							$term_url	= esc_url(get_term_link( $terms[0]->term_id,$taxonomy));
							$term_name	= esc_html($terms[0]->name);
						endif;
				?>
				<li class="c-list_item"><i class="fas fa-users"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php
				endwhile;
			else:
			?>
				<p>現在、お知らせする情報はありません。</p>
			<?php
			endif;
			wp_reset_postdata();
			?>
			</ul>
		</div>
		<div class="c-pagenavi u-align_center ">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $the_query)); } ?>
		</div>
	</div>
</div>


