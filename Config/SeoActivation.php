<?php
/**
 * Seo Activation
 *
 * Activation class for Seo plugin.
 *
 * @package  Croogo
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SeoActivation {

	public $version = '1.0';
/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }
/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Seo'); 
        $controller->Croogo->addAco('Seo/admin_index', array('admin')); 
        $controller->Croogo->addAco('Seo/admin_dashboard', array('admin'));
        $controller->Croogo->addAco('Seo/admin_twitter', array('admin'));
        $controller->Croogo->addAco('Seo/index', array('admin', 'registered', 'public'));
        $controller->Croogo->addAco('Seo/sitemap', array('admin', 'registered', 'public')); 
        $controller->Croogo->addAco('Seo/sitemapxml', array('admin', 'registered', 'public')); 

		$current_version  = Configure::read('Seo.version');
		if($this->version != $current_version){
			switch($current_version){
				case '1.0':
   			        // Add a table to the DB
			        App::uses('File', 'Utility');
			        App::import('Model', 'CakeSchema', false);
					App::import('Model', 'ConnectionManager');
			
					$db = ConnectionManager::getDataSource('default');
					if(!$db->isConnected()) {
						$this->Session->setFlash(__('Could not connect to database.', true), 'default', array('class'=>'error'));
					} else {
						CakePlugin::load('Seo');
						$schema =& new CakeSchema(array('plugin'=>'Seo','name'=>'Seo'));
						$schema = $schema->load();
						foreach($schema->tables as $table => $fields) {
							$create = $db->createSchema($schema, $table);
							$db->execute($create);
						} 
					}      

				break;
	        }
		}

       
        $controller->Setting->write('Seo.remove_settings_on_deactivate','NO',array('description' => 'Remove settings on deactivate','editable' => 1));
        
        $controller->Setting->write('Seo.changefreq','weekly',array('description' => 'Default Changefeq of the SEO Sitemap entries','editable' => 1));
        $controller->Setting->write('Seo.priority',0.8,array('description' => 'Default Priority of the SEO Sitemap entries','editable' => 1));
        $controller->Setting->write('Seo.organize_by_vocabulary',1,array('description' => 'Organize the public sitemap by vocabulary?','editable' => 1));
       
        $controller->Setting->write('Seo.homepage_title',Configure::read('Site.title'),array('description' => 'Homepage Title ','editable' => 1));
        $controller->Setting->write('Seo.homepage_description',Configure::read('Site.tagline'),array('description' => 'Default Homepage META Description','editable' => 1));
       
        $controller->Setting->write('Seo.show_per_page_stats',0,array('description' => 'Show Page Stats','editable' => 1));
        $controller->Setting->write('Seo.hook_google',0,array('description' => 'Provide Hook to Google','editable' => 1));
        $controller->Setting->write('Seo.hook_twitter',0,array('description' => 'Provide Hook to Twitter','editable' => 1));
        $controller->Setting->write('Seo.hook_facebook',0,array('description' => 'Provide Hook to Facebook','editable' => 1));
        
        $controller->Setting->write('Seo.alexa_verification_key','',array('description' => 'Alexa Verification Key','editable' => 1));
        $controller->Setting->write('Seo.bing_webmaster_tools_key','',array('description' => 'Bing Webmaster Tools Key','editable' => 1));
        $controller->Setting->write('Seo.google_adwords_tracking_for_messages','',array('description' => 'Google AdWords Tracking for Messages','editable' => 1));
        $controller->Setting->write('Seo.google_webmaster_tools_key','',array('description' => 'Google Webmaster Tools Key','editable' => 1));
        $controller->Setting->write('Seo.google_analytics_ua','UA-1-XXXXXXXXX',array('description' => 'Google Analytics UA Property','editable' => 1));
        $controller->Setting->write('Seo.google_analytics_domain','your-site.com',array('description' => 'Google Analytics Domain','editable' => 1));
        $controller->Setting->write('Seo.google_places_cid','',array('description' => 'Google Places CID','editable' => 1));
        $controller->Setting->write('Seo.google_plus_cid','',array('description' => 'Google Plus CID','editable' => 1));
        $controller->Setting->write('Seo.google_tag_manager','XXXX-XXXX',array('description' => 'Google Tag Manager Code','editable' => 1));

        $controller->Setting->write('Seo.meta_robots_default','INDEX, FOLLOW',array('description' => 'Default robots entry for individual pages','editable' => 1));
        $controller->Setting->write('Seo.insert_meta_description','1',array('description' => 'Insert META Description tag?','editable' => 1));
        $controller->Setting->write('Seo.insert_meta_robots','1',array('description' => 'Insert META Robots tag?','editable' => 1));
        $controller->Setting->write('Seo.insert_meta_keywords','1',array('description' => 'Insert META Keywords tag?','editable' => 1));
        $controller->Setting->write('Seo.turn_off_promote_by_default','1',array('description' => 'Turn OFF "Promoted" by default','editable' => 1));
        
        $controller->Setting->write('Seo.add_rss_ga_campaign_tags','1',array('description' => 'Add Google Analytics Campaign Trackers to link?','editable' => 1));
        $controller->Setting->write('Seo.rss_ga_medium','rssfeed',array('description' => 'Campaign Medium','editable' => 1));
        $controller->Setting->write('Seo.rss_ga_campaign_name','RSSFeed',array('description' => 'Campaign Name','editable' => 1));
        $controller->Setting->write('Seo.rss_before','',array('description' => 'RSS Post Prefix','editable' => 1));
        $controller->Setting->write('Seo.rss_after','',array('description' => 'RSS Post Suffix','editable' => 1));
        
        $controller->Setting->write('Seo.add_copy_link','1',array('description' => 'Add page link when copied?','editable' => 1));
        $controller->Setting->write('Seo.add_copy_link_ga_campaign_tags','1',array('description' => 'Add Google Analytics Campaign Trackers to link?','editable' => 1));
        $controller->Setting->write('Seo.copy_link_ga_medium','copylink',array('description' => 'Campaign Medium','editable' => 1));
        $controller->Setting->write('Seo.copy_link_ga_campaign_name','CutNPaste',array('description' => 'Campaign Name','editable' => 1));
        $controller->Setting->write('Seo.copy_link_text','Read more at: {{current_page}} Copyright &copy; {{site_title}}',array('description' => 'Text to add when copied.','editable' => 1));

        $controller->Setting->write('Seo.facebook_link','',array('description' => 'Facebook Page','editable' => 1));
        $controller->Setting->write('Seo.facebook_app_key','',array('description' => 'Facebook App Key','editable' => 1));
        $controller->Setting->write('Seo.facebook_app_secret','',array('description' => 'Facebook App Secret','editable' => 1));

        $controller->Setting->write('Seo.twitter_username','',array('description' => 'Twitter Username','editable' => 1));
        $controller->Setting->write('Seo.twitter_consumer_key','',array('description' => 'Twitter Consumer Key','editable' => 1));
        $controller->Setting->write('Seo.twitter_consumer_secret','',array('description' => 'Twitter Consumer Secret','editable' => 1));
        $controller->Setting->write('Seo.twitter_access_token','',array('description' => 'Twitter Access Token','editable' => 1));
        $controller->Setting->write('Seo.twitter_access_token_secret','',array('description' => 'Twitter Access Secret','editable' => 1));

        $controller->loadModel('Region');
        $controller->Region->create();
        $controller->Region->set(array(
            'title'            => 'share_widgets',
            'alias'            => 'share_widgets',
            'description'      => 'A block to contain the social media share links'
        ));
        $controller->Region->save();	

        $controller->loadModel('Block');
        $controller->Block->create();
        $controller->Block->set(array(
            'visibility_roles' => $controller->Node->encodeData(array("1","2","3","4","5","6")),
            'visibility_paths' => '',
            'region_id'        => $controller->Region->id,
            'title'            => 'Google Plus One',
            'alias'            => 'google_plus_one',
            'body'             => '[element:google_plusone_tag plugin="seo"]',
            'show_title'       => 0,
            'status'           => 1
        ));
        $controller->Block->save();
		        	        
        $controller->Block->create();
        $controller->Block->set(array(
            'visibility_roles' => $controller->Node->encodeData(array("1","2","3","4","5","6")),
            'visibility_paths' => '',
            'region_id'        => $controller->Region->id,
            'title'            => 'Twitter Share Button',
            'alias'            => 'twitter_share_button',
            'body'             => '[element:twitter_share_button plugin="seo"]',
            'show_title'       => 0,
            'status'           => 1
        ));
        $controller->Block->save();

        $controller->loadModel('Block');
        $controller->Block->create();
        $controller->Block->set(array(
            'visibility_roles' => $controller->Node->encodeData(array("1","2","3","4","5","6")),
            'visibility_paths' => '',
            'region_id'        => 0,
            'title'            => 'Twitter Profile Widget',
            'alias'            => 'twitter_profile_widget',
            'body'             => '[element:twitter_profile_widget plugin="seo"]',
            'show_title'       => 0,
            'status'           => 1
        ));
        $controller->Block->save();

		$controller->Setting->write('Seo.version', $this->version, array('editable' => 0, 'title' => 'Version'));
    }
/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('Seo'); // ExampleController ACO and it's actions will be removed
        
        if(Configure::read('Seo.remove_settings_on_deactivate') == 'YES' ){
	        $controller->Setting->deleteKey('Seo.alexa_verification_key');
	        $controller->Setting->deleteKey('Seo.bing_webmaster_tools_key');
	        $controller->Setting->deleteKey('Seo.google_adwords_tracking_for_messages');
	        $controller->Setting->deleteKey('Seo.google_webmaster_tools_key');
	        $controller->Setting->deleteKey('Seo.google_analytics_ua');
	        $controller->Setting->deleteKey('Seo.google_analytics_domain');
	        $controller->Setting->deleteKey('Seo.google_places_cid');
	        $controller->Setting->deleteKey('Seo.google_plus_cid');
	        $controller->Setting->deleteKey('Seo.google_tag_manager');
	        
	        $controller->Setting->deleteKey('Seo.changefreq');
	        $controller->Setting->deleteKey('Seo.priority');
	        $controller->Setting->deleteKey('Seo.organize_by_vocabulary');
	        
	        $controller->Setting->deleteKey('Seo.homepage_title');
	        $controller->Setting->deleteKey('Seo.homepage_description');
	        
	        $controller->Setting->deleteKey('Seo.show_per_page_stats');
	        $controller->Setting->deleteKey('Seo.hook_google');
	        $controller->Setting->deleteKey('Seo.hook_twitter');
	        $controller->Setting->deleteKey('Seo.hook_facebook');
	        
	        $controller->Setting->deleteKey('Seo.insert_meta_robots');
	        $controller->Setting->deleteKey('Seo.meta_robots_default');
	        $controller->Setting->deleteKey('Seo.insert_meta_description');
	        $controller->Setting->deleteKey('Seo.insert_meta_keywords');
	        
	        $controller->Setting->deleteKey('Seo.add_rss_ga_campaign_tags');
	        $controller->Setting->deleteKey('Seo.rss_ga_medium');
	        $controller->Setting->deleteKey('Seo.rss_ga_campaign');
	        $controller->Setting->deleteKey('Seo.rss_before');
	        $controller->Setting->deleteKey('Seo.rss_after');
	        
	        $controller->Setting->deleteKey('Seo.add_copy_link');
	        $controller->Setting->deleteKey('Seo.add_copy_link_ga_campaign_tags');
	        $controller->Setting->deleteKey('Seo.copy_link_ga_medium');
	        $controller->Setting->deleteKey('Seo.copy_link_ga_campaign');
	        $controller->Setting->deleteKey('Seo.copy_link_text');
	        
	        $controller->Setting->deleteKey('Seo.facebook_link');
	        $controller->Setting->deleteKey('Seo.facebook_app_key');
	        $controller->Setting->deleteKey('Seo.facebook_app_secret');
	        
	        $controller->Setting->deleteKey('Seo.twitter_username');
	        $controller->Setting->deleteKey('Seo.twitter_consumer_key');
	        $controller->Setting->deleteKey('Seo.twitter_consumer_secret');
	        $controller->Setting->deleteKey('Seo.twitter_access_token');
	        $controller->Setting->deleteKey('Seo.twitter_access_token_secret');
        }
        
        
        $controller->loadModel('Block');
        $block = $controller->Block->find('first', array('conditions'=>array('Block.alias'=>'google_plus_one')));
        if($block){
            $controller->Block->delete($block['Block']['id']);
        }        
        $block = $controller->Block->find('first', array('conditions'=>array('Block.alias'=>'twitter_share_button')));
        if($block){
            $controller->Block->delete($block['Block']['id']);
        }  
              
        $controller->loadModel('Region');
        $region = $controller->Region->find('first', array('conditions'=>array('Region.alias'=>'share_widgets')));
        if($region){
            $controller->Region->delete($region['Region']['id']);
        }        
        
    }
}
?>