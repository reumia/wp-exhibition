<?php
/**
 * 모든 함수의 접두어는 mbt을 붙인다. mytory basic theme의 약자다.
 */
function mbt_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main-nav', '메인 내비게이션' );
}
add_action( 'after_setup_theme', 'mbt_setup' );

function mbt_register_sidebar(){
    register_sidebar(array(
            'name' => '좌측',
            'id' => 'sidebar-left',
            'description' => '제일 왼쪽',
            'before_title' => '<h3 class="sidebar-title">',
            'after_title' => '</h3>'
    ));
    register_sidebar(array(
            'name' => '가운데',
            'id' => 'sidebar-center',
            'description' => '가운데 위치',
            'before_title' => '<h3 class="sidebar-title">',
            'after_title' => '</h3>'
    ));
    register_sidebar(array(
            'name' => '우측',
            'id' => 'sidebar-right',
            'description' => '제일 오른쪽',
            'before_title' => '<h3 class="sidebar-title">',
            'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'mbt_register_sidebar');
/**
 * initialize style and script
 */
function mbt_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Loads main stylesheet.
	 */
	wp_enqueue_style( 'mbt-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'mbt-ie', get_template_directory_uri() . '/style-ie.css', array( 'mbt-style' ) );
	$wp_styles->add_data( 'mbt-ie', 'conditional', 'lt IE 9' );
	
	/*
	 * common.js
	 */
	wp_enqueue_script('mbt-common', get_template_directory_uri() . '/js/common.js', array('jquery'), '', TRUE);
}
add_action( 'wp_enqueue_scripts', 'mbt_scripts_styles' );

if( ! function_exists('getPrintr')){
    /**
    * 변수의 구성요소를 리턴받는다.
    */
    function getPrintr($var, $title = NULL){
        $dump = '';
        $dump .=  '<div align="left">';
        $dump .=  '<pre style="background-color:#000; color:#00ff00; padding:5px; font-size:14px;">';
        if( $title )
        {
            $dump .=  "<strong style='color:#fff'>{$title} :</strong> \n";
        }
        $dump .= print_r($var, TRUE);
        $dump .=  '</pre>';
        $dump .=  '</div>';
        $dump .=  '<br />';
        return $dump;
    }
}

if( ! function_exists('printr')){
    /**
     * 변수의 구성요소를 출력한다.
     */
    function printr($var, $title = NULL)
    {
        $dump = getPrintr($var, $title);
        echo $dump;
    }
}

if( ! function_exists('printr2')){
    /**
     * 변수의 구성요소를 출력하고 멈춘다.
     */
    function printr2($var, $title = NULL)
    {
        printr($var, $title);
        exit;
    }
}

function mbt_paging_nav() {
    global $wp_query;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 )
        return;
    ?>
    <nav class="paging-nav cf" role="navigation">
        <?php if ( get_next_posts_link() ) { ?>
        <div class="paging-nav__next"><?php next_posts_link('다음 ▷'); ?></div>
        <?php } ?>

        <?php if ( get_previous_posts_link() ) { ?>
        <div class="paging-nav__prev"><?php previous_posts_link('◁ 이전'); ?></div>
        <?php } ?>
    </nav><!-- .navigation -->
    <?php
}

function mbt_is_there_sidebar($name_arr){
    $widgets = wp_get_sidebars_widgets();
    foreach ($name_arr as $sidebar_name) {
        if( ! empty($widgets[$sidebar_name])){
            return true;
        }
    }
    return false;
}

function mbt_print_header_others(){
    ?>
    <div class="others-wrapper cf">
        <ul class="others nav">
            <li>
                <a href="<?php bloginfo('rss_url')?>" title="RSS">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-rss.svg" alt="RSS">
                </a>
            </li>
            <li>
                <a href="<?php echo home_url('%ec%9d%b4%eb%a9%94%ec%9d%bc%eb%a1%9c-%ea%b5%ac%eb%8f%85%ed%95%98%ea%b8%b0')?>" title="Newsletter">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-newsletter.svg" alt="Newsletter">
                </a>
            </li>
            <li>
                <a href="https://twitter.com/mytory" title="Twitter">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-twitter.svg" alt="Twitter">
                </a>
            </li>
            <li>
                <a href="https://facebook.com/mytorydev" title="Facebook Page">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-facebook.svg" alt="Facebook Page">
                </a>
            </li>
            <li>
                <a href="https://plus.google.com/112373772451309371763" title="Google+ Page">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-g+.svg" alt="Google+ Page">
                </a>
            </li>
            <li>
                <a href="https://github.com/mytory" title="GitHub">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-github.svg" alt="GitHub">
                </a>
            </li>
            <li>
                <a href="<?php echo home_url('paypal-donation')?>" title="PayPal Donation">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-paypal.svg" alt="PayPal Donation">
                </a>
            </li>
        </ul>
    </div>
    <?
}

function mbt_print_header_others_ie(){
    ?>
    <div class="others-wrapper cf">
        <ul class="others nav">
            <li>
                <a href="<?php bloginfo('rss_url')?>" title="RSS">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-rss.png" alt="RSS">
                </a>
            </li>
            <li>
                <a href="<?php echo home_url('%ec%9d%b4%eb%a9%94%ec%9d%bc%eb%a1%9c-%ea%b5%ac%eb%8f%85%ed%95%98%ea%b8%b0')?>" title="Newsletter">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-newsletter.png" alt="Newsletter">
                </a>
            </li>
            <li>
                <a href="https://twitter.com/mytory" title="Twitter">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-twitter.png" alt="Twitter">
                </a>
            </li>
            <li>
                <a href="https://facebook.com/mytorydev" title="Facebook Page">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-facebook.png" alt="Facebook Page">
                </a>
            </li>
            <li>
                <a href="https://plus.google.com/112373772451309371763" title="Google+ Page">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-g+.png" alt="Google+ Page">
                </a>
            </li>
            <li>
                <a href="https://github.com/mytory" title="GitHub">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-github.png" alt="GitHub">
                </a>
            </li>
            <li>
                <a href="<?php echo home_url('paypal-donation')?>" title="PayPal Donation">
                  <img src="<?php echo get_template_directory_uri()?>/images/icon-paypal.png" alt="PayPal Donation">
                </a>
            </li>
        </ul>
    </div>
    <?
}

include 'functions-custom-post-type.php';
include 'functions-nav.php';