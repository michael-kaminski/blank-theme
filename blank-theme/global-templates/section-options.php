<?php
/**
 * Section Options
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//Section ID
$section_id = $args['section_id_group']['section_id']; //text field
$unique_id = wp_unique_id();
$the_id = $section_id ?: 'content-section-' . $unique_id;

//Section CSS Class Vars
$container = get_theme_mod( 'understrap_container_type' );
$main_text_color_class = $args['main_text_color'];
$bg_color_class = $args['bg_color'];
$top_padding = $args['top_padding'];
$bottom_padding = $args['bottom_padding'];

//Setup Strings
$padding_classes = '';
$style_classes = '';
$padding_classes = "$top_padding $bottom_padding";
$style_classes = "$main_text_color_class $bg_color_class";
$section_classes = "$padding_classes $style_classes";

//Setup $classList variable, in the future will add more css classes
$classList = $section_classes;

//Construct string with class param
$inlineClasses = "class='{$classList}'";




//Section Inline Styles
$has_inline_styles = 'no';
$top_padding_style = '';
$bottom_padding_style = '';
$padding_styles = '';
if ($top_padding == 'custom') :
	$custom_top_padding = $args['custom_padding']['custom_top_padding'];
	$top_padding_style = "padding-top:{$custom_top_padding}px !important;";
endif;
if ($bottom_padding == 'custom') :
	$custom_bottom_padding = $args['custom_padding']['custom_bottom_padding'];
	$bottom_padding_style = "padding-bottom:{$custom_bottom_padding}px !important;";
endif;

//Check for inline styles
if (($bottom_padding == 'custom') || ($top_padding == 'custom')) : 
	//yep, we got em
	$has_inline_styles = 'yes';
	$padding_styles = "$top_padding_style $bottom_padding_style";
endif;

//Setup $styleList variable, in the future will add more styles
$styleList = $padding_styles;
$inlineStyles = "";
if ( $has_inline_styles == 'yes' ) : 
	$inlineStyles = "style='{$styleList}'";
endif; 


?>