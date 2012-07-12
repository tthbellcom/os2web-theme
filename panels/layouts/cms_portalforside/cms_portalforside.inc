<?php

/**
 * Implements hook_panels_layouts().
 */
$plugin = array(
  'title' => t('Portalforside'),
  'category' => t('CMS Theme'),
  'icon' => 'cms_portalforside.png',
  'theme' => 'panels_cms_portalforside',
  'theme arguments' => array('id', 'content'),
  'admin css' => 'cms_portalforside_admin.css',
  'regions' => array(
    'lead' => t('Lead'),
    'middle_top' => t('Middle top'),
    'middle_center' => t('Middle center'),
    'middle_right' => t('Middle right'),
  ),
);
