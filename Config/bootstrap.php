<?php
/**
 * Routes
 *
 * seo_routes.php will be loaded in main app/config/routes.php file.
 */
    Croogo::hookRoutes('Seo');
/**
 * Behavior
 *
 * This plugin's Seo behavior will be attached whenever Node model is loaded.
 */
    Croogo::hookBehavior('Node', 'Seo.Seo', array());
/**
 * Component
 *
 * This plugin's Seo component will be loaded in ALL controllers.
 */
    Croogo::hookComponent('Nodes', 'Seo.Seo');
/**
 * Helper
 *
 * This plugin's Seo helper will be loaded via NodesController.
 */
    Croogo::hookHelper('*', 'Seo.Seo');
/**
 * Admin menu (navigation)
 *
 * This plugin's admin_menu element will be rendered in admin panel under Extensions menu.
 */
    CroogoNav::add('extensions.children.seo', array(
        'title' => __('SEO/OM'),
        'url' => '#',
        'access' => array('admin'),
        'children' => array(
            'general' => array(
                'title' => __('General Options'),
                'url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'index'),
                'access' => array('admin'),
            ),
            'google' => array(
                'title' => __('Google Options'),
                'url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'google'),
                'access' => array('admin'),
            ),
            'twitter' => array(
                'title' => __('Twitter Options'),
                'url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'twitter'),
                'access' => array('admin'),
            ),
            'facebook' => array(
                'title' => __('Facebook Options'),
                'url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'facebook'),
                'access' => array('admin'),
            ),
        ),
    ));
 /**
 * Admin row action
 *
 * When browsing the content list in admin panel (Content > List),
 * an extra link called 'Seo' will be placed under 'Actions' column.
 */

	if(Configure::read('Seo.hook_twitter')){
    	Croogo::hookAdminRowAction('Nodes/admin_index', 'Twitter', 'plugin:seo/controller:seo/action:tweet/:id');
    }
	if(Configure::read('Seo.hook_facebook')){
    	Croogo::hookAdminRowAction('Nodes/admin_index', 'FB', 'plugin:seo/controller:seo/action:facebook_post/:id');
    }
/**
 * Admin tab
 *
 * When adding/editing Content (Nodes),
 * an extra tab with title 'Seo' will be shown with markup generated from the plugin's admin_tab_node element.
 *
 * Useful for adding form extra form fields if necessary.
 */
    Croogo::hookAdminTab('Nodes/admin_add', 'Seo', 'seo.admin_tab_node_add');
    Croogo::hookAdminTab('Nodes/admin_edit', 'Seo', 'seo.admin_tab_node');
?>