# BinkQuickLogout
A plugin for Joomla! 3.x CMS to allow for one-click logout links

Bink's QuickLogout plugin will change existing links in the document to point to Joomla's logout process.  Joomla's logout process normally takes the user to a confirmation page, where the session is logged out after clicking "Log Out" a second time.  The calculated URL generated by QuickLogout will skip that confirmation step, logging the user out immediately.  Configuration options include whether or not redirect after logout, to where the request is redirected, the CSS class to target for URL replacement, and the name of the jQuery variable.

This plugin requires jQuery to be loaded.
