<?php
/**
 * SEO Helper
 *
 * An SEO helper for plugging in SEO Specific settings.
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SeoHelper extends AppHelper {
/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
    public $helpers = array(
        'Html',
        'Layout',
    );

	function __construct($options = array()) {
	}

/**
 * Before render callback. Called before the view file is rendered.
 *
 * @return void
 */
    public function beforeRender() {
    	//check to see if we are doing RSS
    	if($this->params['url']['ext'] == 'rss'){
				//debug($this->Layout->View->viewVars); exit();        
    		if(array_key_exists('nodes', $this->Layout->View->viewVars)){
	    		//check to see if $nodes is set
				debug('has rss'); exit();        
    		}
    	}

		if($this->Layout->View->here == '/'){
			$this->Layout->View->viewVars['title_for_layout'] = Configure::read('Seo.homepage_title');
		}
  	
    	if (!empty($this->params['prefix']) && ($this->params['prefix'] == 'admin')) {
    		//don't want to add tracking stuff here but do want to mod some default settings
    		
    		//we want to coerce the dashboard to pull in our content
    		if($this->Layout->View->action == 'admin_dashboard'){
	        	$dashboard = $this->Layout->View->element('admin_dashboard_loader', array('plugin' => 'seo'));
				$this->Html->scriptBlock($this->replaceTokens($dashboard), array('inline' => false));
	    		//debug($this->Layout->View); exit();
    		}

        } else {
	        //check settings for adding tools
	        if(strlen(Configure::read('Seo.google_analytics_ua'))>0){    
	        	//grab the google analytics element and splice in changes
	        	$google_script = $this->Layout->View->element('google_analytics', array('plugin' => 'seo'));
				$this->Html->scriptBlock($this->replaceTokens($google_script), array('inline' => false));
	    	}
			
			//need to intercept meta tags and stuff into there
    		if($this->Layout->View->params['controller'] == 'contacts' && $this->Layout->View->params['action'] == 'view'){
    			//need to inject a conversion block if we have one for the contact form
    			if(strlen(Configure::read('Seo.adwords_conversion.'.$this->Layout->View->params['pass'][0].'.conversion_id')) > 0){
	        		//$google_script = $this->Layout->View->element('google_adwords_conversion', array('plugin' => 'seo'));	
    			}
    			
	    		//debug($this->Layout->View); exit();
    		}
			
	    	$google_script = $this->Layout->View->element('google_plusone', array('plugin' => 'seo'));
			$this->Html->scriptBlock($this->replaceTokens($google_script), array('inline' => false));

        }
    }
    
    private function replaceTokens($string){
    	$tokens = Configure::read('Seo');
    	foreach($tokens as $token=>$value){
    		$string = str_replace('{{'.$token.'}}',$value, $string);
    	}
    
    	return($string);
    }

	public function meta(){
		//Stolen directly from Fahad... :)

	    $metaForLayout = array();
        if (isset($this->View->viewVars['node']['Seo']) &&
            count($this->View->viewVars['node']['Seo']) > 0) {
            foreach ($this->View->viewVars['node']['Seo'] AS $key => $value) {
                if (strstr($key, 'meta_')) {
                    $key = str_replace('meta_', '', $key);
                    if(Configure::read('Seo.insert_meta_'.$key) > 0){
	                    $metaForLayout[$key] = $value;
                    }
                }
            }
        }
		if($this->Layout->View->here == '/'){
			$metaForLayout['description'] = Configure::read('Seo.homepage_description');
		}

        $output = '';
        foreach ($metaForLayout AS $name => $content) {
            $output .= '<meta name="' . $name . '" content="' . $content . '" />';
        }

        if(strlen(Configure::read('Seo.alexa_verification_key'))>0){    
	       $output .= $this->replaceTokens($this->Layout->View->element('alexa_verification', array('plugin' => 'seo')));
		}		

        if(strlen(Configure::read('Seo.bing_webmaster_tools_key'))>0){    
	       $output .= $this->replaceTokens($this->Layout->View->element('bing_webmaster_tools', array('plugin' => 'seo')));
		}		

        if(strlen(Configure::read('Seo.google_webmaster_tools_key'))>0){    
	       $output .= $this->replaceTokens($this->Layout->View->element('google_webmaster_tools', array('plugin' => 'seo')));
		}		

        return $output;	
	}
    
/**
 * After render callback. Called after the view file is rendered
 * but before the layout has been rendered.
 *
 * @return void
 */
    public function afterRender() {
    	if (!empty($this->params['prefix']) && ($this->params['prefix'] == 'admin')) {
    		//don't want to add tracking stuff here but do want to mod some default settings

        } else {
			if($this->Layout->View->params['controller'] == 'contacts' && $this->Layout->View->params['action'] == 'view'){
	    		//debug($this); exit();
    			//need to inject a conversion block if we have one for the contact form
	        	if(strlen(Configure::read('Seo.adwords_conversion.'.$this->Layout->View->params['pass'][0].'.conversion_id')) > 0){
	        		echo $this->Layout->View->element('google_adwords_conversion', array('plugin' => 'seo'));	
    			}
    			
	    		//debug($this); exit();
    		}

        }
    }
/**
 * Before layout callback. Called before the layout is rendered.
 *
 * @return void
 */
    public function beforeLayout() {
    }
/**
 * After layout callback. Called after the layout has rendered.
 *
 * @return void
 */
    public function afterLayout() {
    }
/**
 * Called after LayoutHelper::setNode()
 *
 * @return void
 */
    public function afterSetNode() {
        // field values can be changed from hooks
        $this->Layout->setNodeField('title', $this->Layout->node('title') . ' [Modified by ExampleHelper]');
    }
/**
 * Called before LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function beforeNodeInfo() {
        return '<p>beforeNodeInfo</p>';
    }
/**
 * Called after LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function afterNodeInfo() {
        return '<p>afterNodeInfo</p>';
    }
/**
 * Called before LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function beforeNodeBody() {
        return '<p>beforeNodeBody</p>';
    }
/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function afterNodeBody() {
        return '<p>afterNodeBody</p>';
    }
/**
 * Called before LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function beforeNodeMoreInfo() {
        return '<p>beforeNodeMoreInfo</p>';
    }
/**
 * Called after LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function afterNodeMoreInfo() {
        return '<p>afterNodeMoreInfo</p>';
    }
}
?>