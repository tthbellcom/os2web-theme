<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
function cmstheme_preprocess_html(&$variables) {
  $theme_path = path_to_theme();
  drupal_add_js($theme_path . '/js/script.js');
}

function cmstheme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = ''; 

  $element['#attributes']['class'][] = 'depth-' . $element['#original_link']['depth'];

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function cmstheme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  
    if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="breadcrumb you-are-here">' . t('Du er her: ') . '</h2>';
/*    $output .= '<div class="breadcrumb">' . implode('<p> > </p> ', $breadcrumb) . '</div>'; */
    $output .= '<div class="breadcrumb">' . implode('<p> > </p> ', $breadcrumb) . '</div>'; 
	  
  
return $output;
  }
}
