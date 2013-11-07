<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <title><?php wp_title( '|', true, 'right' ); ?><?=esc_attr(get_bloginfo('name'))?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
  <![endif]-->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="accessibility" href="#content" title="본문으로 바로 가기">본문으로 바로 가기</a>
<div class="wrapper">
  <div class="header">
    <div class="top-blank"></div>
    <div class="header__row1 cf">
      <div class="site-name">
        <a href="<?=home_url()?>"><?bloginfo( 'name' ); ?></a>
      </div>
      <!--[if lt IE 9]>
      <? mbt_print_header_others_ie(); ?>
      <![endif]-->
      <!--[if gte IE 9]>
      <? mbt_print_header_others(); ?>
      <![endif]-->
      <!--[if !IE]> -->
      <? mbt_print_header_others(); ?>
      <!-- <![endif]-->
      <div class="search-box">
        <form action="<?=home_url()?>">
          <input type="search" name="s" value="<?=isset($_GET['s']) ? $_GET['s'] : ''?>">
          <input class="search-box__submit" type="submit" value="검색">
        </form>
      </div>
    </div>
    <?php 
    $opt = array(
      'theme_location' => 'main-nav', 
      'menu_class' => 'nav nav--fit nav--block nav--banner main-nav',
      'walker' => new MBT_Walker_Nav_Menu,
    );
    ?>
    <div class="main-nav-wrapper">
    <?php
    wp_nav_menu($opt); 
    ?>
    </div>
  </div>