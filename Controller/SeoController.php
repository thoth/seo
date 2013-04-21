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
    public $uses = array('Nodes.Node', 'Taxonomy.Vocabulary', 'Seo');
    
    public $components = array('RequestHandler');
    
    public $helpers = array('Time');
    
    public $defaults = array();
    
    public function beforeFilter() {
        parent::beforeFilter();

		$this->loadModel('Settings.Setting');

        $this->loadModel('Contacts.Contact');
        $contacts = $this->Contact->find('all',array('conditions' => array('Contact.status' => 1)));
        foreach($contacts as $contact){
			//check for existance of key--If not there, we assume is new and stuff a default
			$has_settings = $this->Setting->find('count', array('conditions'=>array('Setting.key'=>'Seo.adwords_conversion_key_'.$contact['Contact']['alias'])));
			if(!$has_settings){

				$this->Setting->write('Seo.adwords_conversion_key_'.$contact['Contact']['alias'],'',array('description' => 'Conversion ID','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_language_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Language','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_format_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Format','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_color_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Color','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_label_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Label','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_value_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Value','editable' => 1));
			}
        }

		$settings = $this->Setting->find('all', array('conditions'=>array('Setting.key LIKE'=>'Seo.%')));
		foreach($settings as $setting){
			$cleaned_key = explode('.', $setting['Setting']['key']);
			$this->defaults[$cleaned_key[1]]['id'] = $setting['Setting']['id'];
			$this->defaults[$cleaned_key[1]]['value'] = $setting['Setting']['value'];
		}
        $this->set('defaults', $this->defaults);
    	
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
        
        $this->loadModel('Contacts.Contact');
        $contacts = $this->Contact->find('all',array('conditions' => array('Contact.status =' => 1)));
        foreach($contacts as $contact){
			//check for existance of key--If not there, we assume is new and stuff a default
			if(!array_key_exists('adwords_conversion_'.$contact['Contact']['alias'].'_google_conversion_key', $this->defaults)){

				$this->Setting->write('Seo.adwords_conversion_key_'.$contact['Contact']['alias'],'',array('description' => 'Conversion ID','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_language_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Language','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_format_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Format','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_color_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Color','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_label_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Label','editable' => 1));
				$this->Setting->write('Seo.adwords_conversion_value_'.$contact['Contact']['alias'],'',array('description' => 'Conversion Value','editable' => 1));
			}
	
        }
       $this->set('inputs', $this->defaults);
        
        $this->set(compact('contacts'));
        
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
        
        $this->loadModel('Taxonomy.Vocabulary');
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
		
		$this->loadModel('Contacts.Message');
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
			//App::uses('HttpSocketOauth', 'Seo.Vendor');
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
	
			if(isset($response->error) || property_exists($response, 'error')){
		        $this->Session->setFlash('FAIL: '.$response->error);
			} else {
		        $this->Session->setFlash('"'.$response->text.'" successfully posted!');
				$this->redirect(array('controller'=>'nodes','action'=>'index', 'plugin'=>false));
			}
		}
        
        $node = $this->Node->read(null, $node_id);
        $this->set(compact('node'));
		
	}

	function admin_nodestats($node_id = null){
	
		if(!empty($node_id)){
	        $node = $this->Node->read(null, $node_id);
	
			$this->autoLayout = false;
			App::import('Vendor', 'Seo.SEOstats', array('file'=>'src'.DS.'class.seostats.php'));
			$seostats = new SEOStats('http://'.$_SERVER['SERVER_NAME'].$node['Node']['path']); //'http://'.$_SERVER['SERVER_NAME'].$this->data['Node']['path']);
			$this->set(compact('seostats'));
		}
	}

	function admin_convertfromcustom(){
		//get a list of all nodes
		$nodes = $this->Node->find('all');

		foreach($nodes as $node){
			//if node has meta then add to SEO
			if(count($node['Seo']) > 0){
				$seo['id'] = $node['Seo']['id'];
			} else {
				$this->Seo->create();
			}
			
			$seo['node_id'] = $node['Node']['id'];
			foreach($node['Meta'] as $meta){
				if(preg_match('/meta_/', $meta['key'])){
					$seo[$meta['key']] = $meta['value'];
				}
			}
			
			if($this->Seo->save($seo)){
				//debug('saved');
			} else {
				//debug('failed');
			}
			$seo = null;			
		}
        $this->Session->setFlash(__('META tags updated', true));
        $this->redirect(array('action'=>'index'));
	}
}
?>