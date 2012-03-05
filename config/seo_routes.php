<?php
    CroogoRouter::connect('/seo/*', array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'index'));
    CroogoRouter::connect('/admin/seo/dashboard', array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'dashboard', 'prefix'=>'admin','admin'=>1));
    CroogoRouter::connect('/admin/seo/nodestats/*', array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'nodestats', 'prefix'=>'admin','admin'=>1));
    CroogoRouter::connect('/sitemap', array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'sitemap'));
    
    //we have to do the following since Core Croogo defines parseExtensions and it overwrites anything we set
    CroogoRouter::connect('/sitemap.xml', array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'sitemapxml'));
    
?>