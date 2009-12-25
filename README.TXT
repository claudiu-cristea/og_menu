$Id$

DESCRIPTION
-----------
Enable users to manage menus inside Organic Groups.

REQUIREMENTS
------------
- Organic Groups module.
- Menu module.

INSTALLATION
------------
- Enable the module.
- Give "administer og menu" permission to dsired roles.

USAGE
-----
- Administrators can create OG menus through the regular menu interface at admin/build/menu/add. Choose a group to associate with the menu.
- Organic group members with the right permission can also manage menus at node/[nid]/og_menu.
- For content types that can be published in groups, users can add a menu link directly from the node creation form.
- For groups content types, users can create an associated menu by checking "Enable menu for this group".

NOTES
-----
Be aware that since menu administration forms are mostly duplicated, if a contrib module adds functionality to menu administration
forms without additional permissions, these additions may be available for OG menu users with 'administer og menu' permission. 
This could allow these users to be able to do things you don't want them to. Please report these modules if you catch one.

TODO/BUGS/FEATURE REQUESTS
--------------------------
- See http://drupal.org/project/issues/og_menu. Please search before filing issues in order to prevent duplicates.

UPGRADING FROM 6.1.x TO 6.2.x
-----------------------------
- Visit update.php to update the database.

CREDITS
-------
Originaly authored and maintained by Scott Ash (ashsc).
New maintainer for 6.2.x version : Julien De Luca (jide).
