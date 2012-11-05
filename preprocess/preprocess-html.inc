<?php 

function cmstheme_alpha_preprocess_html(&$vars) {
  // Setup IE meta tag to force IE rendering mode
	$meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' =>  'IE=8,IE=Edge,chrome=1',
    ),
    '#weight' => '-99999',
  );
  
  // Add header meta tag for IE to head
  drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
}
?>