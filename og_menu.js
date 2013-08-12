/**
 * @file
 * Javascript magic. Shows the eligible menu options when switching groups.
 */

(function ($) {
  Drupal.behaviors.og_menu = {

    attach: function() {
      // Initialize variables
      var originalParent = $('.menu-parent-select').val();

      var enabled = $('#edit-menu-enabled').is(':checked');

      var holder = document.createElement('select');
      
      var menus = Drupal.settings.og_menu.menus;
      
      var admin = Drupal.settings.og_menu.admin;

      // Toggle menu alteration
      function toggle(values) {
      
        // make sure 'values' is always an array, i.e. when using single value select
        if (!(values instanceof Array)) {
          var v = values;
          values = [];
          values[0] = v;
        }

        // Temp-add all options to a hidden holder
        $('.menu-parent-select option:not(.value-none)').appendTo(holder);

        // Iterate over the holder, adding needed items to the menu select
        $.each(values, function(key, val) {
          $('option', holder).each(function() {
            if (admin === true) {
              $(this).appendTo('.menu-parent-select');
            }
            else {
              parts = $(this).val().split(':');
              if (menus[parts[0]] == val) {
                $(this).appendTo('.menu-parent-select');
              }
            }
          });
        });

        // If an option exists with the initial value, set it. We do this because
        // we want to keep the original parent if user just adds a group to the node.
        if (values[0]) {
          if (enabled === true) { // If there is a value on page load.
            $('.menu-parent-select option') .filter(":selected").removeAttr('selected');
            $('.menu-parent-select option[value="' + originalParent + '"]').attr('selected', 'selected');        
          }
          else {
            var menu_keys = Object.keys(menus);
            // Select the menu for the first available group.
            for (var i=0, j=menu_keys.length; i < j; i++) {
              if (menus[menu_keys[i]] == values[0]) {
                $('.menu-parent-select option[value="' + menu_keys[i] + ':0' + '"]').attr('selected', 'selected');
                break;
              }
            }         
          }
        } 

      }

      // Toggle function for OG select
      var toggleSelect = function() {
        if ($(this).val()) {
          toggle($(this).val());
        }
      };

      // Alter menu on OG select change and init
      if ($('select.group-audience').size()) {
        $('select.group-audience').change(toggleSelect).ready(toggleSelect);
      }

      // init
      toggle($('select.group-audience').val());
    }

  };

}(jQuery));