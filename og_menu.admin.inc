<?php
// $Id$

/**
 * Menu callback which shows an overview page of all of member's menus and their descriptions.
 */
function _og_menu_overview_page() {
  global $user;
  $sql = '';
  
  // list only group menus for which member has access...
  if (!user_access('administer group menu')) {
    $sql = db_query("
      SELECT distinct {og_uid}.nid, {og_menu_groups}.*, {menu_custom}.*
      FROM {og_uid} 
      JOIN (
        {menu_custom},
        {og_menu_groups}
      ) 
      ON (
        {menu_custom}.menu_name = {og_menu_groups}.mid 
        AND 
        {og_menu_groups}.gid = {og_uid}.nid
      )
      WHERE {og_uid}.uid = $user->uid 
      ORDER BY {menu_custom}.title
      ;"
    );
  } else {
    // ...unless user is an administrator, then use this
    $sql = db_query("
      SELECT distinct {og_uid}.nid, {og_menu_groups}.*, {menu_custom}.*
      FROM {og_uid} 
      JOIN (
        {menu_custom},
        {og_menu_groups}
      ) 
      ON (
        {menu_custom}.menu_name = {og_menu_groups}.mid 
        AND 
        {og_menu_groups}.gid = {og_uid}.nid
      )
      ORDER BY {menu_custom}.title;"
    );
  }
  
  // generic message
  $message = '<p>Below is a list of group menus you have privileges to administer. If you don\'t see any menus  please contact a site administrator.</p>';
  
  $content = array();
  while ($menu = db_fetch_array($sql)) {
    $menu['href'] = 'admin/build/menu-customize/'. $menu['menu_name'];
    $menu['localized_options'] = array();
    $content[] = $menu;
  }
  
  if (count($content) > 0) {
    $content = theme('admin_block_content', $content);
    
    return $message . $content;
  } else {
    return $message;
  }
  
}