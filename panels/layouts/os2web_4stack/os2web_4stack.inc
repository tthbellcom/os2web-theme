<?php

/**
 * Implements hook_panels_layouts().
 */
$plugin = array(
  'title' => t('OS2Web 4 Stack'),
  'category' => t('CMS Theme'),
  'icon' => 'os2web_4stack.png',
  'theme' => 'panels_os2web_4stack',
  'theme arguments' => array('id', 'content'),
  'admin css' => 'os2web_4stack_admin.css',
  'regions' => array(
    'stack1' => t('Top'),
    'stack2' => t('Midt'),
    'stack3' => t('Bund'),
    'stack4' => t('Nederst'),
  ),
);
