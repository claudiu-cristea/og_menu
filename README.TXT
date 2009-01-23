Overview:
OG Menu extends the capabilities of Organic Groups. It allows a site administrator to create and assign a menu to a specific group. Once assigned, users with appropriate roles (set to be a group administrator and are allowed to administer the menu module) will see a "Menus" tab appear when on the "Groups" page. Under that menu will be a list of menus they are allowed to administer with the following limitations:

- they cannot delete the menu itself
- they cannot reassign the menu to a different group
- cannot access other group pages to put in their own

In short, group administrators with menu administration privileges can edit menu(s) unique to the group(s) for which they administer.


Requirements:
OG Menu relies on the Organic Groups module which relies on the Views module to enable the "Groups" menu item. OG Menu appears as a tab on the "Groups" page.

If you have not already created groups and assigned users to administer them now would be a good time to do that. Also, if your groups have no posts/pages then this module will be of little use to you yet. The very purpose of this module is to help create a menu for your group posts/pages. Since pages make up a menu you will not be able to create a menu if no group pages exist.


Installation:
Following are basic installation instructions. These instructions assume you have the Organic Group module installed and configured properly, have the Views module installed and can see the "Groups" option in your user navigation. If you have both the Organic Groups modules and the "Views" modules enabled and don't see the "Groups" menu item make sure you have enabled the "Organic Groups Views Integration" module, a sub-module of Organic Groups.

1. Copy OG Menu to your site's modules folder.
2. Enable OG Menu in your site's modules settings page.
3. For the role assigned to your group administrator(s), enable "administer menu" on the user permissions page.


Use:
Once enabled the OG Menu module adds the tab "Menus" on the "Groups" page. Under this tab you will find all group menus you are allowed to administer. As a site administrator there is no need to use this tab as it directs the user to the administrator menu page with limitations. So a site administrator can create a menu as normal. Group administrators will only be able to access the menu page through the "Groups" page "Menus" tab.

To enable a menu for a group, first create the menu. You will notice that when you create a menu you there is a list of checkboxes for which group the menu belongs to. Check the appropriate box for the menu you're creating to assign the menu to that group.

Only pages associated with the current menu's group are allowed to be added to the menu. You will find this when trying to add a page to the menu. There is a dropdown list of the group's pages. Titles can be overridden but by default are the title of the page you select from the list.

Editing the menu is as normal. Items may be dragged around in any hierarchical order.