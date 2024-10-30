<?php
/*
Plugin Name: CHBD CSS3 Accordion
Plugin URI: http://www.arefin.me/plugins/chbd-css3-accordion
Description: This plugin will help users to create an eye catching accordion style with pure css3.
Author: Morshedul Arefin
Author URI: http://arefin.me
Version: 1.1
*/


/* Defining the plugin path */
define('CHBD_ACC_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


/* Adding Latest jQuery from Wordpress */
function chbd_accordion_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'chbd_accordion_latest_jquery');

/* Adding plugin javascript file(s) */
wp_enqueue_script('chbd-acc-plugin-js', CHBD_ACC_PLUGIN_PATH.'js/modernizr.custom.js', array('jquery'));

/* Adding Plugin CSS file(s) */
wp_enqueue_style('chbd-acc-plugin-css-style', CHBD_ACC_PLUGIN_PATH.'css/chbd-style.css');



/* Add Accordion Shortcode Button on the Visual Editor of Post Section */
function chbdaccordion_button_function() {
	add_filter ("mce_external_plugins", "chbdaccordion_button_js");
	add_filter ("mce_buttons", "chbdaccordion_button");
}

function chbdaccordion_button_js($plugin_array) {
	$plugin_array['chbdaccordions'] = plugins_url('js/custom-button.js', __FILE__);
	return $plugin_array;
}

function chbdaccordion_button($buttons) {
	array_push ($buttons, 'chbdaccordions');
	return $buttons;
}
add_action ('init', 'chbdaccordion_button_function'); 


/* Files to Include */
require_once('accordion-type.php');

/* Accordion Loop */
function chbd_get_accordion(){
	$chbdaccordion= '<section class="chbd-ac-container">';
	query_posts('post_type=chbd-accordion&posts_per_page=-1&order=ASC');
	global $idd;
	$idd = 0;
	if (have_posts()) : while (have_posts()) : the_post(); 
		$idd = $idd +1;
		$acc_title= get_the_title(); 
		$acc_content= get_the_content(); 
		$chbdaccordion.='
			<div>
				<input id="ac-'.$idd.'" name="accordion-1" type="checkbox" />
				<label for="ac-'.$idd.'">'.$acc_title.'</label>
				<article class="ac-small" style="margin-bottom:0;padding-bottom:0;">
					<p>'.$acc_content.'</p>
				</article>
			</div>
		';		
	endwhile; endif; wp_reset_query();
	$chbdaccordion.= '</section>';
	return $chbdaccordion;
}


/* Add shortcode for the accordion effect. So you can use this in editor. */
function chbd_insert_accordion($atts, $content=null){
	$chbdaccordion= chbd_get_accordion();
	return $chbdaccordion;
}
add_shortcode('chbd_accordion', 'chbd_insert_accordion');

/* Add template tag. So you can use this in themes */
function chbd_accordion(){
	print chbd_get_accordion();
}
?>