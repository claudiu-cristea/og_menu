// $Id$

/**
 * Takes HTML select list object's selected item text
 * Updates link title field with selected item's parsed value
 */
function og_menu_link_title(txt) {
  // if value is not already set by user...
  //if(document.getElementById('edit-menu-link-title').value == '') {
    // update txt (remove node values
    parts = txt.split(' :: ');
    
    // set title using selected item...
    document.getElementById('edit-menu-link-path').value = parts[0];
    document.getElementById('edit-menu-link-title').value = parts[1];
  //}
}