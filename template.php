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
function os2web_theme_preprocess_html(&$variables) {
  $theme_path = path_to_theme();
  drupal_add_js($theme_path . '/js/script.js');
  drupal_add_js($theme_path . '/js/jquery.vegas.js');
  drupal_add_js($theme_path . '/js/jquery.phonenumber.js');
  drupal_add_js($theme_path . '/js/jquery.dagsorden.js', array('scope' => 'footer',
    'weight' => 5));
}

/**
 * Implements hook_menu_link().
 */
function os2web_theme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if (isset($element['#original_link']['depth'])) {
    $element['#attributes']['class'][] = 'depth-' . $element['#original_link']['depth'];
  }

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], array('attributes' => array(
      'title' => $element['#title'])));
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implemensts hook_breadcrumb().
 *
 * tth@bellcom.dk check if there is a better way to do this...
 */
function os2web_theme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  $nid = arg(1);
  if (is_numeric($nid)) {
    $node = node_load($nid);
  }

  if (!empty($breadcrumb)) {
    $output = '<div class="breadcrumb you-are-here">' . t('Du er her: ') . '</div>';
    $title = drupal_get_title();
    $breadcrumb[0] = l(t('Forside'), '<front>', array('attributes' => array('title' => 'Forside')));
    $breadcrumb[] = '<a href="#" title="' . $title . '">' . $title . '</a>';
    if ($title == 'Søg') {
      unset($breadcrumb);
      $breadcrumb[0] = l(t('Forside'), '<front>', array('attributes' => array('title' => 'Forside')));
      $breadcrumb[] = '<a href="#" title="Søgning">Søgning</a>';
    }
    if (isset($node) && is_object($node) && $node->type == 'meeting') {
      unset($breadcrumb);
      $breadcrumb[0] = l(t('Forside'), '<front>', array('attributes' => array('title' => 'Forside')));
      $breadcrumb[] = l(t('Politik & planer'), 'politik-og-planer', array('attributes' => array(
          'title' => 'Politik og planer')));
      $breadcrumb[] = l(t('Søg i dagsordener og referater'), 'dagsorden-og-referat', array(
        'attributes' => array('title' => 'Søg i dagsordner og referater')));
      $breadcrumb[] = l(t($title), '#');
    }
    $output .= '<div class="breadcrumb">' . implode('<div class="bread-crumb"> &gt; </div> ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Implements hook_preprocess_region().
 */
function os2web_theme_preprocess_region(&$vars) {
  global $user;
  if ($vars['region'] === 'sidebar_first') {
    $dirty = FALSE;
    $ignored_blocks = array(
      'views_sitestuktur-block_1',
      'alpha_debug_sidebar_first',
      'context',
    );
    if (arg(0) === 'search') {
      $dirty = TRUE;
    }
    else {
      foreach ($vars['elements'] as $key => $element) {
        if (!(($key[0] === '#') || (in_array($key, $ignored_blocks)))) {
          $dirty = TRUE;
          break;
        }
      }
    }
    if (!$dirty) {
      $vars['content'] = drupal_render(menu_tree(variable_get('os2web_default_menu', 'navigation')));
    }
  }
}

/**
 * Implements hook_form_alter().
 *
 * tekst i søgefelt
 */
function os2web_theme_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#attributes']['placeholder'] = t('søg på syddjurs.dk');
  }
  if (isset($form_state['view']->name) && $form_state['view']->name == 'meetings_search') {

    // tth@bellcom.dk ændret tekst på select i meetings-search
    $form['committee']['#options']['All'] = t('Vælg udvalg');
    $form['from_date']['value']['#date_format'] = 'd-m-Y';
    $form['to_date']['value']['#date_format'] = 'd-m-Y';
  }
}

/**
 * Implements hook_file_field_item().
 */
function os2web_theme_filefield_item($file, $field) {
  if (filefield_view_access($field['field_name']) && filefield_file_listed($file, $field)) {
    // Default theming.
    return theme('filefield_file', $file);
  }
  return '';
}
