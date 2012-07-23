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
  drupal_add_js($theme_path . '/js/jquery.vegas.js');
  drupal_add_js($theme_path . '/js/jquery.phonenumber.js');
  drupal_add_js($theme_path . '/js/jquery.dagsorden.js', array('scope' => 'footer', 'weight' => 5));
}

function cmstheme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = ''; 

  if (isset($element['#original_link']['depth'])) {
    $element['#attributes']['class'][] = 'depth-' . $element['#original_link']['depth'];
  }

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/*tth@bellcom.dk check if there is a better way to do this...*/
function cmstheme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  $nid = arg(1);
  if (is_numeric($nid)){
    $node = node_load($nid);
  }

  if (!empty($breadcrumb)) {
    $output = '<div class="breadcrumb you-are-here">' . t('Du er her: ') . '</div>';
    $title = drupal_get_title();
    $breadcrumb[0] = l('Forside', '<front>');
    $breadcrumb[] = '<a href="#">'.$title.'</a>';
    if ($title == 'Søg') {
		unset($breadcrumb);
		$breadcrumb[0] = l('Forside', '<front>');
		$breadcrumb[] = '<a href="#">Søgning</a>';
	}
  if (isset($node) && is_object($node) && $node->type == 'meeting') {
		unset($breadcrumb);
		$breadcrumb[0] = l('Forside', '<front>');
		$breadcrumb[] = l('Politik & planer', 'politik-og-planer');		
		$breadcrumb[] = l('Søg i dagsordener og referater', 'meetings-search');		
		$breadcrumb[] = l($title, '#');
        }
    $output .= '<div class="breadcrumb">' . implode('<div class="bread-crumb"> > </div> ', $breadcrumb) . '</div>';
return $output;
  }
}

function cmstheme_preprocess_region(&$vars) {
  global $user;
  if ($vars['region'] === 'sidebar_first') {
    $dirty = false;
    $ignored_blocks = array(
      'views_sitestuktur-block_1',
      'alpha_debug_sidebar_first',
      'context',
    );
    if ($user->uid==0 && arg(1)==23200) {
//      error_log("Var: \$vars = " . print_r(array_keys($vars['elements']), 1));
      }
    if (arg(0)==='search') $dirty=true;
    else
    foreach ($vars['elements'] as $key => $element) {
       if (!(($key[0]==='#') || (in_array($key,$ignored_blocks)))) {
         $dirty=true;
         break;
       }
    }
    if (!$dirty) {
     $vars['content'] = drupal_render(menu_tree(variable_get('os2web_default_menu','navigation')));
    }
  }
}


/*
 * tekst i søgefelt
 */
function cmstheme_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#attributes']['placeholder'] = t('søg på syddjurs.dk');
  }
  if(isset($form_state['view']->name) && $form_state['view']->name == 'meetings_search') {
    
    //tth@bellcom.dk ændret tekst på select i meetings-search
    $form['committee']['#options']['All'] = t('Vælg udvalg');
    $form['from_date']['value']['#date_format'] = 'd-m-Y';
    $form['to_date']['value']['#date_format'] = 'd-m-Y';

  }

}


function cmstheme_filefield_item($file, $field) {
  error_log('MARK - ' . basename(__FILE__) . ':' . __LINE__ . ' in ' . __FUNCTION__ . '()');
   if (filefield_view_access($field['field_name']) && filefield_file_listed($file, $field)) {
   error_log("Var: \$file = " . print_r($file, 1));

     return theme('filefield_file', $file); //default theming
   }
   return '';
}
