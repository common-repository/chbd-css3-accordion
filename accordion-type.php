<?php
/* Some setup */
define('CHBD_ACCORDION_NAME', "Accordions");
define('CHBD_ACCORDION_SINGLE', "Accordion");
define('CHBD_ACCORDION_TYPE', "chbd-accordion");
define('CHBD_ACCORDION_ADD_NEW_ITEM', "Add New Accordion");
define('CHBD_ACCORDION_EDIT_ITEM', "Edit Accordion");
define('CHBD_ACCORDION_NEW_ITEM', "New Accordion");
define('CHBD_ACCORDION_VIEW_ITEM', "View Accordion");

/* Register custom post for Accordion */
function chbd_accordion_custom_post_register() {  
    $args = array(  
        'labels' => array (
			'name' => __( CHBD_ACCORDION_NAME ),
			'singular_label' => __(CHBD_ACCORDION_SINGLE),  
			'add_new_item' => __(CHBD_ACCORDION_ADD_NEW_ITEM),
			'edit_item' => __(CHBD_ACCORDION_EDIT_ITEM),
			'new_item' => __(CHBD_ACCORDION_NEW_ITEM),
			'view_item' => __(CHBD_ACCORDION_VIEW_ITEM),
		), 
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor')  
       );  
    register_post_type(CHBD_ACCORDION_TYPE , $args );  
}
add_action('init', 'chbd_accordion_custom_post_register');

?>