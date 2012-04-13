<?php

/**
 * Implements hook_panels_layouts().
 */
$plugin = array(
  'title' => t('Nyhed'),
  'category' => t('CMS Theme'),
  'icon' => 'cmstheme_node_news.png',
  'theme' => 'panels_cmstheme_node_news',
  'theme arguments' => array('id', 'content'),
  'admin css' => 'cmstheme_node_news_admin.css',
  'regions' => array(
    'lead' => t('Top'),
    'middle' => t('Middle'),
    'right' => t('Right'),
  ),
);
