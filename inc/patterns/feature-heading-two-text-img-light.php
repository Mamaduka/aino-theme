<?php
/**
 * Heading, two paragraphs and horizontal image. (Light version)
 *
 * @package aino
 */

return array(
	'title'      => __( ' Heading, two paragraphs and horizontal image (Light)', 'aino' ),
	'categories' => array( 'aino-feature' ),
	'content'    => '<!-- wp:group {"align":"full","backgroundColor":"background-primary","paddingBottom":17} -->
	<div class="wp-block-group alignfull has-background-primary-background-color has-background pb__17"><!-- wp:separator {"color":"border","className":"is-style-wide"} -->
	<hr class="wp-block-separator has-text-color has-background has-border-background-color has-border-color is-style-wide"/>
	<!-- /wp:separator -->
	
	<!-- wp:ainoblocks/grid-container {"paddingTop":15} -->
	<div class="wp-block-ainoblocks-grid-container alignwide pt__15"><div class="wp-block-ainoblocks-grid-container__inner"><!-- wp:ainoblocks/grid-item {"gridColumnStartDesktop":2,"gridColumnEndDesktop":6,"gridColumnStartTablet":1,"gridColumnEndTablet":7,"gridColumnStartMobile":1,"gridColumnEndMobile":13,"marginTopDesktop":0,"marginBottomDesktop":0,"marginTopMobile":0,"marginBottomMobile":9} -->
	<div class="wp-block-ainoblocks-grid-item col_start_d__2 col_end_d__6 col_start_t__1 col_end_t__7 col_start_m__1 col_end_m__13 align-self__start justify-self__start no-stacking mt_d__0 mt_m__0 mb_d__0 mb_m__9"><!-- wp:heading {"textColor":"font-primary","fontSize":"m"} -->
	<h2 class="has-font-primary-color has-text-color has-m-font-size">New Ideas</h2>
	<!-- /wp:heading -->
	
	<!-- wp:paragraph {"textColor":"font-tertiary","fontSize":"s","paddingTop":7} -->
	<p class="has-font-tertiary-color has-text-color has-s-font-size pt__7">Innovative designs and new beginnings</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:ainoblocks/grid-item -->
	
	<!-- wp:ainoblocks/grid-item {"gridColumnStartDesktop":8,"gridColumnEndDesktop":12,"gridColumnStartTablet":7,"gridColumnEndTablet":13,"gridColumnStartMobile":1,"gridColumnEndMobile":13,"marginTopDesktop":0,"marginBottomDesktop":0,"marginBottomMobile":0} -->
	<div class="wp-block-ainoblocks-grid-item col_start_d__8 col_end_d__12 col_start_t__7 col_end_t__13 col_start_m__1 col_end_m__13 align-self__start justify-self__start no-stacking mt_d__0 mb_d__0 mb_m__0"><!-- wp:heading {"level":3,"textColor":"font-primary","fontSize":"xxs","paddingBottom":4} -->
	<h3 class="has-font-primary-color has-text-color has-xxs-font-size pb__4">Built for the WordPress editor</h3>
	<!-- /wp:heading -->
	
	<!-- wp:paragraph {"textColor":"font-secondary","fontSize":"s","paddingBottom":11} -->
	<p class="has-font-secondary-color has-text-color has-s-font-size pb__11"><meta charset="utf-8">We have been building designs for WordPress for over ten years and we are excited to announce our latest project. The development of the WordPress editor creates a fresh perspective of the role themes play in the WP ecosystem.</p>
	<!-- /wp:paragraph -->
	
	<!-- wp:heading {"level":3,"textColor":"font-primary","fontSize":"xxs","paddingBottom":4} -->
	<h3 class="has-font-primary-color has-text-color has-xxs-font-size pb__4">A flexible module system</h3>
	<!-- /wp:heading -->
	
	<!-- wp:paragraph {"textColor":"font-secondary","fontSize":"s"} -->
	<p class="has-font-secondary-color has-text-color has-s-font-size">With our Aino base theme, a growing block pattern library and a creative block collection we can bring innovative, fun and individual website designs to you. Let’s create websites that don’t look like every other template.</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:ainoblocks/grid-item -->
	
	<!-- wp:ainoblocks/grid-item {"gridColumnStartDesktop":2,"gridColumnEndDesktop":12,"gridColumnStartTablet":1,"gridColumnEndTablet":13,"gridColumnStartMobile":1,"gridColumnEndMobile":13,"marginTopDesktop":0,"marginBottomDesktop":0,"marginBottomMobile":0} -->
	<div class="wp-block-ainoblocks-grid-item col_start_d__2 col_end_d__12 col_start_t__1 col_end_t__13 col_start_m__1 col_end_m__13 align-self__start justify-self__start no-stacking mt_d__0 mb_d__0 mb_m__0"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","paddingTop":14} -->
	<figure class="wp-block-image size-large pt__14"><img src="' . get_stylesheet_directory_uri() . '/assets/images/pattern-lib/feature-01.jpg" alt=""/></figure>
	<!-- /wp:image --></div>
	<!-- /wp:ainoblocks/grid-item --></div></div>
	<!-- /wp:ainoblocks/grid-container --></div>
	<!-- /wp:group -->',
);