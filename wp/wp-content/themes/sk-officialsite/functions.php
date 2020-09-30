<?php
add_action( 'after_setup_theme', 'my_theme_setup' );



function my_theme_setup() {


	// titleタグの出力
	add_theme_support( 'title-tag' );

	// HTML5のサポート
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// アイキャッチのサポート
	add_theme_support( 'post-thumbnails' );
	add_filter( 'post_thumbnail_html', 'custom_attribute' );

	// contact formのサポート
	add_filter( 'wpcf7_load_js', '__return_false' );
	add_filter( 'wpcf7_load_css', '__return_false' );

	// Jquery
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '3.3.1');

	/*-------------------------------------------*/
	/*  カスタムロゴ
	/*-------------------------------------------*/
	add_theme_support( 'custom-logo', array(
    //	'height'      => 600,
    //	'width'       => 400,
      'flex-width' => true,
      'flex-height' => true,
    ));
  
	/*-------------------------------------------*/
	/*  抜粋有効（固定ページ）
	/*-------------------------------------------*/
	add_post_type_support( 'page', 'excerpt' );

	/*-------------------------------------------*/
	/*  カスタムメニュー
	/*-------------------------------------------*/
	// カスタムメニューの使用（add_theme_supportは使わなくても問題ありません）
	add_theme_support('menus');
	register_nav_menus(array(
		'Global' => 'Global Navigation',
		'Header' => 'Header Navigation',
		'Footer_l' => 'Footer Left Navigation',
		'Footer_c' => 'Footer Center Navigation',
		'Footer_r' => 'Footer Right Navigation',
		'Mobile' => 'Mobile Navigation'
	));

	add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
	add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
	add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
	 
	function my_css_attributes_filter($var) {
		return is_array($var) ? array_intersect($var,  array( 'current-menu-item' , 'menu-item-has-children', 'l-mnavi_lists') ) : '';
	}

	add_filter('walker_nav_menu_start_el', 'add_class_on_link', 10, 4);
		function add_class_on_link($item_output, $item){
		return preg_replace('/(<a.*?)/', '$1' . " class='l-mnavi_list-item'", $item_output);
	}

	remove_action('wp_head','rest_output_link_wp_head');
	remove_action('wp_head','wp_oembed_add_discovery_links');
	remove_action('wp_head','wp_oembed_add_host_js');

	
	// generatorを非表示にする
	remove_action('wp_head', 'wp_generator');

	// EditURIを非表示にする
	remove_action('wp_head', 'rsd_link');

	// wlwmanifestを非表示にする
	remove_action('wp_head', 'wlwmanifest_link');


	
	add_action('init', function() {
		remove_filter('the_title', 'wptexturize');
		remove_filter('the_content', 'wptexturize');
		remove_filter('the_excerpt', 'wptexturize');
		remove_filter('the_title', 'wpautop');
		remove_filter('the_content', 'wpautop');
		remove_filter('the_excerpt', 'wpautop');
		remove_filter('the_editor_content', 'wp_richedit_pre');
	});
	add_filter('tiny_mce_before_init', function($init) {
		$init['wpautop'] = false;
		$init['apply_source_formatting'] = ture;
		return $init;
	});

	// remove_filter('the_content', 'wpautop');
	// remove_filter('the_excerpt', 'wpautop');

}


function is_mysmartphone() {
  $ua = $_SERVER['HTTP_USER_AGENT'];
  if (
  ( strpos($ua, 'Android') && strpos($ua, 'Mobile') )
  || strpos($ua, 'iPhone') // iPhone
  || strpos($ua, 'iPod') // iPod touch
  || strpos($ua, 'Windows Phone') // Windows Phone
  || strpos($ua, 'BlackBerry')
  || strpos($ua, 'BlackBerry 9500')
  || strpos($ua, 'BlackBerry 9520')
  || strpos($ua, 'BlackBerry 9530')
  || strpos($ua, 'BlackBerry 9550')
  || strpos($ua, 'BlackBerry 9800')
  || strpos($ua, 'BB') // BlackBerryスマートフォン
  || strpos($ua, 'RIM Tablet OS') // BlackBerryタブレット
  || strpos($ua, 'WebOS') // Palm
  || strpos($ua, 'incognito') // その他の iPhone browser
  || strpos($ua, 'webmate') // その他の Other iPhone browser
  || strpos($ua, 'dream') // バージョン 1.5 より前の Android
  || strpos($ua, 'CUPCAKE') // Android バージョン 1.5 以降
  || strpos($ua, 'Silk') // Kindle に付属の Amazon 製ブラウザ
  ) {
  return true;
  } else {
  return false;
  }
 }

function kstyle_widgets_init() {
	register_sidebar( array(
    'name'          => 'サイドバー（ブログ）',
		'id'            => 'sidebar-1',
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kstyle_widgets_init' );

function kstyle_widgets_init2() {
	register_sidebar( array(
    'name'          => 'サイドバー（新着）',
		'id'            => 'sidebar-2',
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kstyle_widgets_init2' );

/*-------------------------------------------*/
/*  カスタムロゴ関連
/*-------------------------------------------*/
function mytheme_custom_logo() {
    // Try to retrieve the Custom Logo
    $output = '';
    if (function_exists('get_custom_logo'))
        $output = get_custom_logo();

    // Nothing in the output: Custom Logo is not supported, or there is no selected logo
    // In both cases we display the site's name
    if (empty($output))
        $output = '<h1><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';

    echo $output;
}



// function get_the_custom_logo() {
// 	if ( function_exists( 'the_custom_logo' ) ) {
// 		the_custom_logo();
// 	}
// }

// add_filter('get_custom_logo','change_logo_class');


// function change_logo_class($html)
// {
// 	$html = str_replace('class="custom-logo-link"', 'class="navbar-brand"', $html);
// 	return $html;
// }

/*-------------------------------------------*/
/*  アイキャッチ画像関連
/*-------------------------------------------*/

function custom_attribute( $html ){
	// width height を削除する
	$html = preg_replace('/(width|height)="\d*"\s/', '', $html);
	return $html;
}

//アイキャッチ画像の定義と切り抜き
add_action( 'after_setup_theme', 'baw_theme_setup' );

function baw_theme_setup() {
	add_image_size('small_thumbnail', 90, 56 ,true );
	add_image_size( 'middle_thumbnail', 150, 93, true );
	add_image_size('large_thumbnail', 300, 185, true );
}


//add_filter('walker_nav_menu_start_el', 'add_class_on_link', 10, 4);
/*-------------------------------------------*/
/*  SVG有効化
/*-------------------------------------------*/
/*
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $new_filetypes['svgz'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');
add_action('wp_AJAX_svg_get_attachment_url', 'get_attachment_url_media_library');
*/

/*
 * 投稿にアーカイブ(投稿一覧)を持たせるようにします。
 * ※ 記載後にパーマリンク設定で「変更を保存」してください。
 */
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog'; // ページ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

/*-------------------------------------------*/
/*  moreを前後で表示
/*-------------------------------------------*/

function get_the_divided_content( $more_link_text = null, $stripteaser = 0, $more_file = '' ) {
	$regex = '#(<p><span id="more-[\d]+"></span></p>|<span id="more-[\d]+"></span>)#';
	$content = get_the_content( $more_link_text, $stripteaser, $more_file );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	if ( preg_match( $regex, $content ) ) {
		list( $content_array['before'], $content_array['after'] ) = preg_split( $regex, $content, 2 );
	} else {
		$content_array['before'] = '';
		$content_array['after'] = $content;
	}
	return $content_array;
}

//概要（抜粋）の文字数調整
function new_excerpt_mblength($length) {
	return ( wp_is_mobile() ) ? 28 : 80;
}
add_filter('excerpt_mblength', 'new_excerpt_mblength');


function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//モバイルとPCでWP Multibyte Patchの文字数を個別に指定


function get_post_type_query() {
    if ( is_archive() ) {
      return get_query_var( 'post_type' );
    }

    return get_post_type();
}

function is_parent_slug() {
	global $post;
	if ($post->post_parent) {
		$post_data = get_post($post->post_parent);
		return $post_data->post_name;
	}
}

function is_subpage() {
  global $post;
  if (is_page() && $post->post_parent){
    $parentID = $post->post_parent;
    return $parentID;
  } else {
    return false;
  };
};

remove_filter('the_content', 'wpautop');
remove_filter( 'the_excerpt', 'wpautop' );

/*
	アーカイブページで現在のカテゴリー・タグ・タームを取得する
*/
function get_current_term(){

	$id;
	$tax_slug;

	if(is_category()){
		$tax_slug = "category";
		$id = get_query_var('cat');
	}else if(is_tag()){
		$tax_slug = "post_tag";
		$id = get_query_var('tag_id');
	}else if(is_tax()){
		$tax_slug = get_query_var('taxonomy');
		$term_slug = get_query_var('term');
		$term = get_term_by("slug",$term_slug,$tax_slug);
		$id = $term->term_id;
	}

	return get_term($id,$tax_slug);
}


/*-------------------------------------------*/
/*  カスタム投稿タイプ
/*-------------------------------------------*/

function customize_menus(){
	global $menu;
	$menu[19] = $menu[10];  //メディアの移動
	unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );

/* カスタム投稿タイプ（お知らせ）
-------------------------------------------------- */
add_action( 'init', 'register_cpt_news' );
function register_cpt_news() {
	register_post_type( 'news', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( '新着情報' ),
			'singular_name' => __( '新着情報' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
	//カスタムタクソノミー、カテゴリタイプ
  register_taxonomy(
    'news-cat',
    'news',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'singular_label' => 'カテゴリー',
      'public' => true,
      'show_ui' => true
    )
  );
}

/* カスタム投稿タイプ（議会活動）
-------------------------------------------------- */
add_action( 'init', 'register_cpt_activity' );
function register_cpt_activity() {
	register_post_type( 'activity', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( '議会活動' ),
			'singular_name' => __( '議会活動' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
	//カスタムタクソノミー、カテゴリタイプ
  register_taxonomy(
    'activity-cat',
    'activity',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'singular_label' => 'カテゴリー',
      'public' => true,
      'show_ui' => true
    )
  );
}

/* カスタム投稿タイプ（活動報告）
-------------------------------------------------- */
add_action( 'init', 'register_cpt_activity_report' );
function register_cpt_activity_report() {
	register_post_type( 'activity_report', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( '活動報告' ),
			'singular_name' => __( '活動報告' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
	//カスタムタクソノミー、カテゴリタイプ
  register_taxonomy(
    'activity_report-cat',
    'activity_report',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'singular_label' => 'カテゴリー',
      'public' => true,
      'show_ui' => true
    )
  );
}

/* カスタム投稿タイプ（定例会）
-------------------------------------------------- */
add_action( 'init', 'register_cpt_meeting' );
function register_cpt_meeting() {
	register_post_type( 'meeting', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( '定例会' ),
			'singular_name' => __( '定例会' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
	//カスタムタクソノミー、カテゴリタイプ
  register_taxonomy(
    'meeting-cat',
    'meeting',
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'singular_label' => 'カテゴリー',
      'public' => true,
      'show_ui' => true
    )
  );
}


add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );
function add_post_taxonomy_restrict_filter() {
    global $post_type;
    if ( 'policy' == $post_type ) {
        ?>
        <select name="policy-cat">
            <option value="">カテゴリー指定なし</option>
            <?php
            $terms = get_terms('policy-cat');
            foreach ($terms as $term) { ?>
                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
        <?php
    }
}

add_action( 'init', 'register_cpt_report' );
function register_cpt_report() {
	register_post_type( 'report', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( '区議会レポート' ),
			'singular_name' => __( '区議会レポート' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
}

/* カスタム投稿タイプ（関連サイト）
-------------------------------------------------- */
add_action( 'init', 'register_cpt_link' );
function register_cpt_link() {
	register_post_type( 'link', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( '関連サイト' ),
			'singular_name' => __( '関連サイト' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
}

/* カスタム投稿タイプ（バナー）
-------------------------------------------------- */
add_action( 'init', 'register_cpt_banner' );
function register_cpt_banner() {
	register_post_type( 'banner', //カスタム投稿タイプ名を指定
		array(
			'labels' => array(
			'name' => __( 'バナー' ),
			'singular_name' => __( 'バナー' )
		),
		'public' => true,
		'has_archive' => true, /* アーカイブページを持つ */
		'menu_position' =>5, //管理画面のメニュー順位
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ,'comments' ),
			)
	);
}

// function my_add_columns($columns) {
//   $columns['my_column_name'] = 'activity-cat';
//   return $columns;
// }
// add_filter( 'manage_edit-activity_columns', 'my_add_columns' );


/* マニュアル
-------------------------------------------------- */
add_action ( 'admin_menu', 'artist_add_pages' );
function artist_add_pages () {
	add_menu_page('マニュアル', 'マニュアル', 'manage_options', 'manual', 'manual');
}

function add_side_menu_manual() {
	//pdfのurlを設定
	$pdf_url = get_bloginfo('template_directory') . '/doc/manual.pdf';
	?>
	<script type="text/javascript">
		jQuery( function( $ ) {
			$ ("#toplevel_page_manual a").attr("href","<?php echo $pdf_url; ?>"); //hrefを書き換える
			$ ("#toplevel_page_manual a").attr("target","_blank"); //target blankを追加する
		} );
	</script>
<?php
}
add_action('admin_footer', 'add_side_menu_manual');

function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
return $query;
}
add_filter('pre_get_posts','SearchFilter');