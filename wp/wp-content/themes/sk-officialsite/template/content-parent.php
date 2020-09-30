<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage kawagoeseiichi
 * @since kawagoeseiichi 2.0
 */
?>

	<?php
		// 現在のpost-type
		$post_type = get_post_type_query();
		// 現在表示しているページの投稿IDから投稿情報を取得
		$page = get_post( get_the_ID() );
		// 投稿のスラッグを取得
		$slug = $page->post_name;


		if (is_page() && $post->post_parent) {
			// the_title( '<h2 class="c-content-title">', '</h2>' );
			switch ($slug){
				case 'towns':
					$slug = "town";
				  break;
				case 'supports':
					$slug = "support";
				  break;
				case 'cultures':
					$slug = "culture";
				  break;
				default:
					$slug = "future";
			}
			$paged = (int) get_query_var('paged');
			$args = array(
				  'posts_per_page' => 12,
					'paged' => $paged,
			    'post_type' => 'policy',
			    'taxonomy' => 'policy-cat',
			    'term' => $slug,
				  'orderby' => 'menu_order',
				  'order' => 'DESC',
					'post_status' => 'publish'
			);

		} else {
				// the_title( '<h2 class="c-content-title">', '</h2>' );
				// 親ページ
				$parentId = get_the_ID();
				$args = array(
					'posts_per_page' => -1,
					'post_type' => $post_type,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_parent' => $parentId
				);
		}

		$st_query = new WP_Query( $args );
	?>
	<div class="l-content_body">

<?php if ( $st_query->have_posts() ): ?>

  <?php if (is_page() && $post->post_parent): ?>
    <?php while ( $st_query->have_posts() ) : $st_query->the_post(); ?>
			<article class="c-cardhorizontal">
				<a href="<?php the_permalink(); ?>" class="c-cardhorizontal_inner" title="<?php the_permalink(); ?>">
					<div class="c-cardhorizontal_media">
					<?php if (has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('full', array('class' => '')); ?>
						<!-- <img src="https://picsum.photos/g/800/494"> -->
					<?php	} else { ?>
						<!-- <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/no-imagethum.png" alt="" /> -->
						<img src="https://picsum.photos/g/800/494">
					<?php } ?>
					</div>
					<div class="c-cardhorizontal_content">
						<p class="c-cardhorizontal_title"><?php the_title(); ?></p>
						<p class="c-card_text"><?php the_excerpt(); ?></p>
					</div>
				</a>
			</article>
			<?php endwhile; ?>
		<div class="c-pagenavi u-align_center">
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query' => $st_query)); } ?>
		</div>
	<?php else: ?>
	<div class="row justify-content-center">
    <?php while ( $st_query->have_posts() ) : $st_query->the_post(); ?>
			<div class="col-12 col-md-6 u-card-border">
				<div class="c-card">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="c-card_inner">
						<div class="c-card_media">
							<div class="c-card_media-inner">
								<?php the_post_thumbnail('full', array('class' => '')); ?>
							</div>
						</div>
						<h3 class="c-card_title"><?php the_title(); ?></h3>
						<p class="c-card_text"><?php the_excerpt(); ?></p>
					</a>
				</div>
			</div>
    <?php endwhile; ?>
	</div>
	<?php endif ?>
  <?php wp_reset_query(); ?>
<?php else: ?>
  <p>関連リンクはありません</p>
<?php endif; ?>
</div>









