
      <aside class="l-side">
        <div class="side_widget clearfix google_search" id="google_search-3">
          <form action="<?php echo esc_url( home_url('/') ); ?>" method="get" id="searchform" class="searchform">
            <div>
              <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
              <input type="hidden" value="post" name="post_type" id="post_type">
              <div class="submit_button"><input id="searchsubmit" type="submit" name="sa" value=""></div>
            </div>
          </form>
        </div>
      </aside>