
<!DOCTYPE html>
<html lang="js">
  <head>
    <title><?php wp_title(); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php
    if(is_page( 'contact' )) {
      if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
      }

      if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        wpcf7_enqueue_styles();
      }
    }

    ?>
    <?php wp_head(); ?>
  </head>
  <body>
  <div class="l-wrapper">
    <header class="l-header">
      <div class="l-container">
        <nav class="l-global-nav p-global-nav">
          <div id="navbar">
            <div id="logo" class="reverse">
              <div class="mobile-btn" onclick="openNav()">&#9776;</div>
              <div class="p-header__logo"><img class="p-header__logo--img" src="<?php echo get_template_directory_uri(); ?>/dist/img/logo.svg" alt=""></div>
            </div>
            <?php
              wp_reset_query();
                wp_nav_menu( array(
                'theme_location'=>'Global',
                'container'     =>'',
                'menu_class'    =>'',
                'items_wrap' => '<ul class="l-global-nav_list p-global-nav__list" id="links">%3$s</ul>'
              ));
            ?>
          </div>
        </nav>
        <!-- Mobile Menu -->
        <div id="mySidenav" class="sidenav">
          <p><a style="cursor:pointer;" class="closebtn" onclick="closeNav()">&times;</a></p>
          <?php
              wp_reset_query();
                wp_nav_menu( array(
                'theme_location'=>'Global',
                'container'     =>'',
                'menu_class'    =>'',
                'items_wrap' => '<ul>%3$s</ul>'
              ));
            ?>
        </div>
      </div>
    </header>
