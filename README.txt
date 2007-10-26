$Id$

OG Menu
---------------------------------------------------------

OG Menu is a module that alters the menu module so that groups can create menus which are only visible to them and not other groups. For the moment these menus are created automatically for groups; if a group is created, and a member of that group goes to admin/build/menu, a new menu is created. Members of that OG can add/delete links to the menu but cannot delete the menu itself or see menus for groups to which they are not a member; only users with the "administer all menus" permission have full control over all menus. The menus are automatically activated using a SQL query to {block} in the database.

In addition, OG Menu limits the audience of a node to those in the user's groups, so that they cannot post in other groups. OG Menu also modifies the menu settings in node_form so that, when selecting a menu, the user is only presented with the menus of their groups as options for "Parent item". Finally OG Menu provides minor functionality to allow users to control publishing options without the need for "administer nodes" permission.

Note About Access Control
---------------------------------------------------------
Even though I've effectively removed the use of "administer menus" in my module with my own access controls, it is still important to grant this permission to the user - it is necessary in order to allow the user to add a link to their menu without creating the page, traversing to the OG Menu page, and adding it there. I tried to override this functionality in OG Menu but I didn't have much success in doing so. If anyone can help out with this, that would be excellent.

Things That Need Work
---------------------------------------------------------
- Allow for creation of submenus
- For "Menu settings" on node_form, the "Parent item" normally allows the user to select a menu or any of its children as a parent. This needs to be reintroduced - I had no intentions of leaving it out, it was simply a low priority to get it to work for my needs at the time.
- Get the "Menu settings" fieldset on node_form to work using OG Menu permissions and not Menu permissions
- Create settings page?