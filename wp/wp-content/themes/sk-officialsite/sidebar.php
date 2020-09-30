
      <aside class="l-side">

        <article class="p-widget">
        <?php
            $args = array(
                'posts_per_page' => -1,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'banner',
                'post_status' => 'publish'
            );
            $the_query = new WP_Query($args);
            if ( $the_query->have_posts() ) :
              while ( $the_query->have_posts() ) : $the_query->the_post();
                $url = get_field('link');
                $image_url = get_field('image');

          ?>
                <?php
                  $frame = get_field('frame'); // 値の代入
                  if($frame == "true") {
                ?>
                <p class="p-widget__banner"><a href="<? echo $url; ?>" target="_blank"><img src="<?php echo $image_url; ?> " alt="" width="100%" height="auto"></a></p>
                <?php
                  } else {
                ?>
                <p class="p-widget__banner"><a href="<? echo $url; ?>"><img src="<?php echo $image_url; ?> " alt="" width="100%" height="auto"></a></p>
                <?php
                  }
                  ?>
          <?php
              endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </article>
        <article class="p-widget">
          <?php dynamic_sidebar('sidebar-1'); ?>
        </article>
        <!-- <article class="p-widget">
        <ul class="side_menu">
  <?php
    // $args = array(
    //   'type'            => 'monthly', //アーカイブの種類。月別、年別、週別などが選べる。
    //   'limit'           => '', //取得するアーカイブ数の上限。デフォルトは無制限。
    //   'format'          => 'html', //アーカイブのフォーマット。リスト形式やドロップダウンメニューなどを選べる。
    //   'before'          => '', //リンクテキストの前につけるテキスト(formatがhtmlまたはcustomの場合のみ)
    //   'after'           => '', //リンクテキストの後につけるテキスト(formatがhtmlまたはcustomの場合のみ)
    //   'show_post_count' => false, //投稿数を表示するか。デフォルトは表示しない(false)。
    //   'echo'            => 1, //表示するか、値として返すか。デフォルトは表示する(true)。
    //   'order'           => 'DESC' //リストの並び順。ASC：上から1月→12月、DESC：上から12月→1月
    // );
    // wp_get_archives( $args );
  ?>
</ul>
</article> -->
        <article class="p-widget side_widget clearfix google_search" id="google_search-3">
          <form action="<?php echo esc_url( home_url('/') ); ?>" method="get" id="searchform" class="searchform">
            <div>
              <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
              <input type="hidden" value="post" name="post_type" id="post_type">
              <div class="submit_button"><input id="searchsubmit" type="submit" name="sa" value=""></div>
            </div>
          </form>
        </article>
      </aside>