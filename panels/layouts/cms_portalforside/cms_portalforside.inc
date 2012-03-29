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
    'left' => t('Venstre'),
    'right_top' => t('Højre top'),
    'right_middle' => t('Højre center'),
    'right_bottom' => t('Højre bund'),
  ),
);
