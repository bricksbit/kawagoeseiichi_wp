  <footer class="l-footer">
    <div class="l-footer-top ptb60">
      <div class="l-container">
        <div class="l-footer-wrap">
          <div class="l-footer--left p-footer-info">
            <h3 class="p-footer-logo">
              <a class="p-footer-logo__link" href="#" target="_blank"><img class="p-footer-logo--img" src="<?php echo get_template_directory_uri(); ?>/dist/img/f-logo.svg" alt=""></a>
            </h3>
            <p>〒124-8555</p>
            <p>東京都葛飾区立石5-13-1</p>
            <p>葛飾区役所内　区議会控室</p>
            <p>電話：03-5654-8523</p>
            <p class="pb30">FAX：03-3697-0137</p>
          </div>
          <div class="l-footer--center p-footer-nav__left">
            <?php wp_nav_menu( array(
                'theme_location'=>'Footer_c',
                'container'     =>'',
                'menu_class'    =>'',
                'items_wrap' => '<ul class="l-footer-menu">%3$s</ul>'
              ));
              ?> 
          </div>
          <div class="l-footer--right p-footer-nav__right">
            <?php wp_nav_menu( array(
              'theme_location'=>'Footer_r',
              'container'     =>'',
              'menu_class'    =>'',
              'items_wrap' => '<ul class="l-footer-menu">%3$s</ul>'
            ));
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="l-footer-bottom ptb15">
      <div class="l-container">
        <p class="l-footer-copyright"><small>Copyright &copy; <script type="text/javascript">$y=2017;$ny=new Date().getFullYear();document.write($ny>$y?$y+'-'+$ny:$y);</script>&nbsp;Kawagoe Seiichi Official Site.All Rights Reserved.</small></p>
      </div>
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/js/app.js"></script>
<!-- <script>
      $('.c-accordion').liloAccordion();
    </script>
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '736945479798418',
          xfbml      : true,
          version    : 'v2.8'
        });
        FB.AppEvents.logPageView();
      };

      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/ja_JP/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script> -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91342158-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-91342158-1'); -->
</script>

    <?php wp_footer(); ?>

</body>
</html>
