<?php
/**
 * Seo Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.tigerclawtech.com
 */
class SeoController extends SeoAppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    public $name = 'Seo';
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    public $uses = array('Node', 'Setting', 'Vocabulary', 'Seo');
    
    public $components = array('RequestHandler');
    
    public $helpers = array('Time');
    
    public $defaults = array();
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $settings =& ClassRegistry::init('Setting');
		
		//general settings
        $this->defaults['insert_meta_keywords'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.insert_meta_keywords'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['insert_meta_description'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.insert_meta_description'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['insert_meta_robots'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.insert_meta_robots'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['meta_robots_default'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.meta_robots_default'), 'fields' => array('Setting.id','Setting.value')));

		//facebook settings
        $this->defaults['facebook_link'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.facebook_link'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['facebook_app_key'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.facebook_app_key'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['facebook_app_secret'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.facebook_app_secret'), 'fields' => array('Setting.id','Setting.value')));

		//twitter settings
        $this->defaults['twitter_username'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.twitter_username'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['twitter_consumer_key'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.twitter_consumer_key'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['twitter_consumer_secret'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.twitter_consumer_secret'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['twitter_access_token'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.twitter_access_token'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['twitter_access_token_secret'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.twitter_access_token_secret'), 'fields' => array('Setting.id','Setting.value')));

		//sitemap defaults
        $this->defaults['changefreq'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.changefreq'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['priority'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.priority'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['organize_by_vocabulary'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.organize_by_vocabulary'), 'fields' => array('Setting.id','Setting.value')));

		//alexa
        $this->defaults['alexa_verification_key'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.alexa_verification_key'), 'fields' => array('Setting.id','Setting.value')));

		//bing
        $this->defaults['bing_webmaster_tools_key'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.bing_webmaster_tools_key'), 'fields' => array('Setting.id','Setting.value')));
        
		//google
        $this->defaults['google_adwords_tracking_for_messages'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.google_adwords_tracking_for_messages'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['google_webmaster_tools_key'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.google_webmaster_tools_key'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['google_analytics_ua'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.google_analytics_ua'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['google_analytics_domain'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.google_analytics_domain'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['google_places_cid'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.google_places_cid'), 'fields' => array('Setting.id','Setting.value')));
        $this->defaults['google_plus_cid'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.google_plus_cid'), 'fields' => array('Setting.id','Setting.value')));

		//singular page
        $this->defaults['homepage_title'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.homepage_title'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['homepage_description'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.homepage_description'), 'fields' => array('Setting.id','Setting.value')));

		//social media settings
        $this->defaults['show_per_page_stats'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.show_per_page_stats'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['hook_google'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.hook_google'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['hook_twitter'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.hook_twitter'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['hook_facebook'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.hook_facebook'), 'fields' => array('Setting.id','Setting.value')));

		//RSS Settings
        $this->defaults['rss_before'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.rss_before'),'fields' => array('Setting.id','Setting.value')));
        $this->defaults['rss_after'] = $settings->find('all',array('conditions' => array('Setting.key =' => 'Seo.rss_after'), 'fields' => array('Setting.id','Setting.value')));

        if (!empty($this->defaults['changefreq'])) {
            $this->defaults['insert_meta_keywords'] =  $this->defaults['insert_meta_keywords'][0]['Setting'];
            $this->defaults['insert_meta_description'] =  $this->defaults['insert_meta_description'][0]['Setting'];
            $this->defaults['insert_meta_robots'] =  $this->defaults['insert_meta_robots'][0]['Setting'];
            $this->defaults['meta_robots_default'] =  $this->defaults['meta_robots_default'][0]['Setting'];

            $this->defaults['facebook_link'] =  $this->defaults['facebook_link'][0]['Setting'];
            $this->defaults['facebook_app_key'] =  $this->defaults['facebook_app_key'][0]['Setting'];
            $this->defaults['facebook_app_secret'] =  $this->defaults['facebook_app_secret'][0]['Setting'];

            $this->defaults['twitter_username'] =  $this->defaults['twitter_username'][0]['Setting'];
            $this->defaults['twitter_consumer_key'] =  $this->defaults['twitter_consumer_key'][0]['Setting'];
            $this->defaults['twitter_consumer_secret'] =  $this->defaults['twitter_consumer_secret'][0]['Setting'];
            $this->defaults['twitter_access_token'] =  $this->defaults['twitter_access_token'][0]['Setting'];
            $this->defaults['twitter_access_token_secret'] =  $this->defaults['twitter_access_token_secret'][0]['Setting'];

            $this->defaults['changefreq'] =  $this->defaults['changefreq'][0]['Setting'];
            $this->defaults['priority'] =  $this->defaults['priority'][0]['Setting'];        
            $this->defaults['organize_by_vocabulary'] =  $this->defaults['organize_by_vocabulary'][0]['Setting'];        

            $this->defaults['alexa_verification_key'] =  $this->defaults['alexa_verification_key'][0]['Setting'];
            $this->defaults['bing_webmaster_tools_key'] =  $this->defaults['bing_webmaster_tools_key'][0]['Setting'];        
            $this->defaults['google_adwords_tracking_for_messages'] =  $this->defaults['google_adwords_tracking_for_messages'][0]['Setting'];        
            $this->defaults['google_webmaster_tools_key'] =  $this->defaults['google_webmaster_tools_key'][0]['Setting'];        
            $this->defaults['google_analytics_ua'] =  $this->defaults['google_analytics_ua'][0]['Setting'];
            $this->defaults['google_analytics_domain'] =  $this->defaults['google_analytics_domain'][0]['Setting'];
            $this->defaults['google_places_cid'] =  $this->defaults['google_places_cid'][0]['Setting'];
            $this->defaults['google_plus_cid'] =  $this->defaults['google_plus_cid'][0]['Setting'];
            
            $this->defaults['homepage_title'] =  $this->defaults['homepage_title'][0]['Setting'];        
            $this->defaults['homepage_description'] =  $this->defaults['homepage_description'][0]['Setting'];        
            
            $this->defaults['show_per_page_stats'] =  $this->defaults['show_per_page_stats'][0]['Setting'];        
            $this->defaults['hook_google'] =  $this->defaults['hook_google'][0]['Setting'];        
            $this->defaults['hook_twitter'] =  $this->defaults['hook_twitter'][0]['Setting'];        
            $this->defaults['hook_facebook'] =  $this->defaults['hook_facebook'][0]['Setting'];        

            $this->defaults['rss_before'] =  $this->defaults['rss_before'][0]['Setting'];        
            $this->defaults['rss_after'] =  $this->defaults['rss_after'][0]['Setting'];        

            $this->set('defaults', $this->defaults);
        }
    	
    	$this->Node->bindModel(
        	array('hasOne'=>array('Seo')),
        	false
    	);
    }

    public function admin_index() {
        $this->set('title_for_layout', __('SEO/OM - General Options', true));
        
        if(!empty($this->data)) {
            $settings =& ClassRegistry::init('Setting');
            foreach ($this->data['Seo'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('SEO/OM Options have been saved', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('inputs', $this->defaults);
    }

    public function admin_twitter() {
        $this->set('title_for_layout', __('SEO/OM - Twitter Settings', true));
        
        if(!empty($this->data)) {
            $settings =& ClassRegistry::init('Setting');
            foreach ($this->data['Seo'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('SEO/OM Twitter Options have been saved', true));
            $this->redirect(array('action'=>'twitter'));
        }
        $this->set('inputs', $this->defaults);
    }

    public function admin_facebook() {
        $this->set('title_for_layout', __('SEO/OM - Facebook Settings', true));
        
        if(!empty($this->data)) {
            $settings =& ClassRegistry::init('Setting');
            foreach ($this->data['Seo'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('SEO/OM Facebook Options have been saved', true));
            $this->redirect(array('action'=>'facebook'));
        }
        $this->set('inputs', $this->defaults);
    }

    public function admin_google() {
        $this->set('title_for_layout', __('SEO/OM - Google Settings', true));
        
        if(!empty($this->data)) {
            $settings =& ClassRegistry::init('Setting');
            foreach ($this->data['Seo'] as $key=>$setting) {
                $settings->id = $setting['id'];
                $settings->saveField('value',$setting['value']);
            }            
            $this->Session->setFlash(__('SEO/OM Google Options have been saved', true));
            $this->redirect(array('action'=>'google'));
        }
        $this->set('inputs', $this->defaults);
    }
    
    function index() {
      
        $this->pageTitle = __('Sitemap', true);
        
        $this->Node->contain('Meta');
        
        $sitemapData = $this->__getSiteMapData($this->Node->find('all',array('conditions' => array('Node.status =' => 1))));
        
        $this->set(compact('sitemapData'));
        
    }
    
    function sitemap() {
        $this->set('title_for_layout', __('Sitemap', true));
        //$this->Node->contain('Seo');
        $this->Node->recursive = 1;
        $nodes = $this->Node->find('all',array('conditions' => array('Node.status =' => 1)));
        
        $this->loadModel('Vocabulary');
        $this->Vocabulary->bindModel(array(
        	'hasAndBelongsToMany'=>array(
		        'Term' => array(
		            'className' => 'Term',
		            'with' => 'Taxonomy',
		            'joinTable' => 'taxonomy',
		            'foreignKey' => 'vocabulary_id',
		            'associationForeignKey' => 'term_id',
		            'fields'=>array('Term.id', 'Term.title', 'Term.slug')
	        	)
	        )
        ));
        $this->Vocabulary->unbindModel(array(
        	'hasAndBelongsToMany'=>array('Type')
        ));
/*
        $this->Taxonomy->bindModel(array(
        	'hasAndBelongsToMany'=>array('Node')
        ));
*/
        $this->Vocabulary->recursive = 2;
        $vocabularies = $this->Vocabulary->find('all', array('fields'=>array('Vocabulary.id', 'Vocabulary.title','Vocabulary.alias')));
        
        foreach($vocabularies as $key=>$vocabulary){
        	foreach($vocabulary['Term'] as $termkey=>$term){
        		//get the nodes
        		$nodesbyterms = $this->Node->find('all', array('conditions'=>array(
        			'Node.status' => 1,
		            'Node.terms LIKE' => '%"' . $term['slug'] . '"%',
		            'OR' => array(
		                'Node.visibility_roles' => '',
		                'Node.visibility_roles LIKE' => '%"' . $this->Croogo->roleId . '"%',
		            ))));
        		$vocabularies[$key]['Term'][$termkey]['Node'] = $nodesbyterms;
        	}
        }
        $this->set(compact('nodes', 'vocabularies'));
    }
    
    function sitemapxml() {
        Configure::write ('debug', 0);
        
        $this->layout = 'xml/default';        
        $this->Node->contain('Seo');
        $sitemapData = $this->__getSiteMapData($this->Node->find('all',array('conditions' => array('Node.status =' => 1))));
        $this->set(compact('sitemapData'));
        $this->RequestHandler->respondAs('xml');
    }
    
    
    function __getSiteMapData ($data) {        
         $sitemapData = array();
        //debug($nodes);
        foreach ($data as $key=>$d) {
            $sitemapData[$key]['Node']['title'] = $d['Node']['title'];
            $sitemapData[$key]['Node']['path'] = $d['Node']['path'];
            $sitemapData[$key]['Node']['type'] = $d['Node']['type'];
            $sitemapData[$key]['Node']['updated'] = $d['Node']['updated'];
            $sitemapData[$key]['Node']['Seo'] = $d['Seo'];            
        }
        
        return $sitemapData;
    }

	function admin_dashboard(){
		$this->autoLayout = false;

		$vocabulary_count = 0;
		$meta_keywords_count = 0;
		$meta_description_count = 0;
		$this->Node->unbindModel(array(
			'hasMany'=>array('Comment')
		));
		$nodes = $this->Node->find(
			'all',
			array(
				'conditions'=>array('Node.status'=>1),
				'fields'=>array(
					'Node.id',
					'Node.terms',
					'Seo.meta_keywords',
					'Seo.meta_description',
				)
			)
		);
		foreach($nodes as $node){
			if(count($node['Taxonomy'])<1) $vocabulary_count++;
			if(count($node['Seo'])){
				if(strlen($node['Seo']['meta_keywords'])<1) $meta_keywords_count++;
				if(strlen($node['Seo']['meta_description'])<1) $meta_description_count++;
			}
		}
		
		$last_published = $this->Node->find('first', array('fields'=>array('MAX(Node.updated) as last_published'), 'order'=>'Node.updated DESC'));
		$published_count = $this->Node->find('count', array('conditions'=>array('Node.status'=>1)));
		$duplicate_titles = $this->Node->find('all', array('fields'=>array('COUNT(Node.title) as count', 'Node.title'),'conditions'=>array('Node.status'=>1), 'group'=>'Node.title HAVING count > 1'));
		
		$this->loadModel('Message');
		$message_count = $this->Message->find('count');
		$message_count_read = $this->Message->find('count', array('conditions'=>array('Message.status'=>1)));
		$message_count_unread = $this->Message->find('count', array('conditions'=>array('Message.status'=>0)));
		
		$this->loadModel('Comment');
		$comment_count = $this->Comment->find('count');
		$comment_count_approved = $this->Comment->find('count', array('conditions'=>array('Comment.status'=>1)));
		$comment_count_unapproved = $this->Comment->find('count', array('conditions'=>array('Comment.status'=>0)));
		
		
		$this->set(compact('vocabulary_count', 'meta_keywords_count', 'meta_description_count', 'last_published', 'published_count', 'duplicate_titles', 'message_count','message_count_read','message_count_unread', 'comment_count','comment_count_approved','comment_count_unapproved'));
	}
	
	function admin_seostats($node_id = null){
		App::import('Vendor', 'Seo.SEOstats', array('file'=>'src'.DS.'class.seostats.php'));
		
		$node = $this->Node->read(null, $node_id);
		
//		$seostats = new SEOStats('http://'.$_SERVER['SERVER_NAME'].$node['Node']['path']);
		$seostats = new SEOStats('http://ha.com/');
		debug($seostats->Google_Page_Rank()); 
		debug($seostats->Google_Backlinks_Total_API()); 
		debug($seostats->Google_Mentions_Total()); 
		//debug($seostats->Google_Performance_Analysis()); 
		debug($seostats->Google_Pagespeed_Score()); 
		debug($seostats->Yahoo()); 
		debug($seostats->Alexa()); 
		debug($seostats->Facebook_Mentions_Total()); 
		debug($seostats->Twitter_Mentions_Total()); 
		
		
		exit();
		
	}

	function admin_duplicate_titles(){
        $this->set('title_for_layout', __('Duplicate Titles', true));
	
		$dbo = $this->Node->getDataSource();
		$subQuery = $dbo->buildStatement(
		    array(
		        'fields' => array('`Node2`.`title`'),
		        'table' => $dbo->fullTableName($this->Node),
		        'alias' => 'Node2',
		        'limit' => null,
		        'offset' => null,
		        'joins' => array(),
		        'conditions' => array('Node2.status'=>1),
		        'order' => null,
		        'group' => 'Node2.title HAVING count(Node2.id) > 1'
		    ),
		    $this->User
		);
		$subQuery = ' INNER JOIN (' . $subQuery . ') dup ON Node.title = dup.title ';
		//$subQueryExpression = $dbo->expression($subQuery);
		
		$joins[] = $subQuery;
		$order[] = 'Node.title';
		
		$nodes = $this->Node->find('all', compact('joins', 'order'));
		$this->set(compact('nodes'));
				
	}

	function admin_no_taxonomy(){
        $this->set('title_for_layout', __('Pages without Taxonomy', true));
	
		$this->Node->unbindModel(array(
			'hasMany'=>array('Comment')
		));
		$nodesTemp = $this->Node->find(
			'all',
			array(
				'conditions'=>array('Node.status'=>1),
			)
		);
		$nodes = array();
		foreach($nodesTemp as $node){
			if(count($node['Taxonomy'])<1) $nodes[] = $node;
		}	
		$this->set(compact('nodes'));
	}

	function admin_no_keywords(){
        $this->set('title_for_layout', __('Pages without META Keywords', true));
	
		$this->Node->unbindModel(array(
			'hasMany'=>array('Comment')
		));
		$nodesTemp = $this->Node->find(
			'all',
			array(
				'conditions'=>array('Node.status'=>1),
			)
		);
		$nodes = array();
		foreach($nodesTemp as $node){
			//if(count($node['Seo'])){
				if(strlen($node['Seo']['meta_keywords'])<1) $nodes[] = $node;
			//}
		}		
		$this->set(compact('nodes'));
	}

	function admin_no_description(){
        $this->set('title_for_layout', __('Pages without META Descriptions', true));
	
		$this->Node->unbindModel(array(
			'hasMany'=>array('Comment')
		));
		$nodesTemp = $this->Node->find(
			'all',
			array(
				'conditions'=>array('Node.status'=>1),
				'fields'=>array(
				)
			)
		);
		$nodes = array();
		foreach($nodesTemp as $node){
			//if(count($node['Seo'])){
				if(strlen($node['Seo']['meta_description'])<1) $nodes[] = $node;
			//}
		}		
		$this->set(compact('nodes'));
	}
	
	function admin_tweet($node_id = null){
        $this->set('title_for_layout', __('SEO/OM - Twitter Post', true));
        
		if(!empty($this->data)){
			App::import('Vendor', 'Seo.HttpSocketOauth');
			$Http = new HttpSocketOauth();
			$request = array(
				'method' => 'POST',
				'uri' => array(
					'host' => 'api.twitter.com',
					'path' => '1/statuses/update.json',
				),
				'auth' => array(
					'method' => 'OAuth',
					'oauth_token' => Configure::read('Seo.twitter_access_token'), 
					'oauth_token_secret' => Configure::read('Seo.twitter_access_token_secret'), 
					'oauth_consumer_key' => Configure::read('Seo.twitter_consumer_key'),
					'oauth_consumer_secret' => Configure::read('Seo.twitter_consumer_secret'),
				),
				'body' => array(
					'status' => $this->data['Twitter']['post'],
				),
			);
			$response = json_decode($Http->request($request));
	
			if(strlen($response->{'error'}) > 0){
		        $this->Session->setFlash('FAIL: '.$response->{'error'});
			} else {
		        $this->Session->setFlash('"'.$response->{'text'}.'" successfully posted!');
				$this->redirect(array('controller'=>'nodes','action'=>'index', 'plugin'=>false));
			}
		}
        
        $node = $this->Node->read(null, $node_id);
        $this->set(compact('node'));
		
	}

}
?>