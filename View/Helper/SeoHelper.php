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
 		'Layout'
 	);
 	
 	public $view;
 
	function __construct(View $view, $options = array()) {
		parent::__construct($view, $options);
		$this->view = $view;
		//$this->helpers[] = 'Layout';
	}

/**
 * Before render callback. Called before the view file is rendered.
 *
 * @return void
 */
    public function beforeRender($viewFile) {
    	if (!empty($this->request->params['prefix']) && ($this->request->params['prefix'] == 'admin')) {
    		//don't want to add tracking stuff here but do want to mod some default settings
    		
    		//we want to coerce the dashboard to pull in our content
    		if($this->request->params['action'] == 'admin_dashboard'){
	        	$dashboard = $this->view->element('admin_dashboard_loader', array(), array('plugin' => 'seo'));
				$this->Html->scriptBlock($this->replaceTokens($dashboard), array('inline' => false));
	    		//debug($this->view); exit();
    		}

        } else {
	        //check settings for adding tools
	        if(strlen(Configure::read('Seo.google_tag_manager'))>0){    
	        	//grab the google analytics element and splice in changes
	        	$google_script = $this->view->element('google_tag_manager', array(), array('plugin' => 'seo'));
				$this->Html->scriptBlock($this->replaceTokens($google_script), array('inline' => false));
	    	} elseif(strlen(Configure::read('Seo.google_analytics_ua'))>0){    
	        	//grab the google analytics element and splice in changes
	        	$google_script = $this->view->element('google_analytics', array(), array('plugin' => 'seo'));
				$this->Html->scriptBlock($this->replaceTokens($google_script), array('inline' => false));
	    	}
			
	        if(in_array('ext', $this->request->params) && ($this->request->params['ext'] == '' && $this->request->params['ext'] == 'html') && strlen(Configure::read('Seo.add_copy_link'))>0){    
	        	//grab the google analytics element and splice in changes
	        	$copy_link = $this->view->element('copy_link', array('plugin' => 'seo'));
	        	$copy_link = $this->replaceTokens($copy_link);
	        	
	        	//do specific tag replacements
	        	$campaign_tracker = '';
	        	if(strlen(Configure::read('Seo.add_copy_link_ga_campaign_tags'))>0){
		        	$campaign_tracker = '?utm_medium='.Configure::read('Seo.copy_link_ga_medium').'&utm_campaign='.Configure::read('Seo.copy_link_ga_campaign_name');
	        	}
	        	$copy_link = str_replace('{{current_page}}', 'http://'.$_SERVER['SERVER_NAME'].$this->here.$campaign_tracker, $copy_link);
	        	$copy_link = str_replace('{{website}}', 'http://'.$_SERVER['SERVER_NAME'].$campaign_tracker, $copy_link);
	        	$copy_link = str_replace('{{page_title}}', $this->view->viewVars['title_for_layout'], $copy_link);
	        	$copy_link = str_replace('{{site_title}}', Configure::read('Site.title'), $copy_link);
	        	$copy_link = str_replace('{{year}}', date('Y'), $copy_link);
	        	$copy_link = str_replace('{{month}}', date('m'), $copy_link);
	        	$copy_link = str_replace('{{monthname}}', date('F'), $copy_link);
	        	$copy_link = str_replace('{{day}}', date('d'), $copy_link);
	        	
				$this->Html->scriptBlock($copy_link, array('inline' => false));
	    	}
			
			//need to intercept meta tags and stuff into there
    		if($this->request->params['controller'] == 'contacts' && $this->request->params['action'] == 'view'){
    			//need to inject a conversion block if we have one for the contact form
    			if(strlen(Configure::read('Seo.adwords_conversion.'.$this->request->params['pass'][0].'.conversion_id')) > 0){
	        		//$google_script = $this->view->element('google_adwords_conversion', array('plugin' => 'seo'));	
    			}
    			
	    		//debug($this->view); exit();
    		}
			
	    	$google_script = $this->view->element('google_plusone', array(), array('plugin' => 'seo'));
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
        if (isset($this->view->viewVars['node']['Seo']) &&
            count($this->view->viewVars['node']['Seo']) > 0) {
            foreach ($this->view->viewVars['node']['Seo'] AS $key => $value) {
                if (strstr($key, 'meta_')) {
                    $key = str_replace('meta_', '', $key);
                    if(Configure::read('Seo.insert_meta_'.$key) > 0){
	                    $metaForLayout[$key] = $value;
                    }
                }
            }
        }

		if($this->view->here == '/'){
			$metaForLayout['description'] = Configure::read('Seo.homepage_description');
		}

        $output = '';
        foreach ($metaForLayout AS $name => $content) {
        	if(strlen($content)){
	            $output .= '<meta name="' . $name . '" content="' . $content . '" />';
	        }
        }

        if(strlen(Configure::read('Seo.alexa_verification_key'))>0){    
	       $output .= $this->replaceTokens($this->view->element('alexa_verification', array(), array('plugin' => 'seo')));
		}		

        if(strlen(Configure::read('Seo.bing_webmaster_tools_key'))>0){    
	       $output .= $this->replaceTokens($this->view->element('bing_webmaster_tools', array(), array('plugin' => 'seo')));
		}		

        if(strlen(Configure::read('Seo.google_webmaster_tools_key'))>0){    
	       $output .= $this->replaceTokens($this->view->element('google_webmaster_tools', array(), array('plugin' => 'seo')));
		}		

        return $output;	
	}
    
/**
 * After render callback. Called after the view file is rendered
 * but before the layout has been rendered.
 *
 * @return void
 */
    public function afterRender($viewFile) {
    	if (!empty($this->request->params['prefix']) && ($this->request->params['prefix'] == 'admin')) {
    		//don't want to add tracking stuff here but do want to mod some default settings

        } else {
			if($this->request->params['controller'] == 'contacts' && $this->request->params['action'] == 'view'){
	    		//debug($this); exit();
    			//need to inject a conversion block if we have one for the contact form
	        	if(strlen(Configure::read('Seo.adwords_conversion_key_'.$this->request->params['pass'][0])) > 0){

	        		$element = $this->view->element('google_adwords_conversion', array(), array('plugin' => 'seo'));	
	        		$element = str_replace('{{google_conversion_key}}', Configure::read('Seo.adwords_conversion_key_'.$this->request->params['pass'][0]), $element);
	        		$element = str_replace('{{google_conversion_language}}', Configure::read('Seo.adwords_conversion_language_'.$this->request->params['pass'][0]), $element);
	        		$element = str_replace('{{google_conversion_format}}', Configure::read('Seo.adwords_conversion_format_'.$this->request->params['pass'][0]), $element);
	        		$element = str_replace('{{google_conversion_color}}', Configure::read('Seo.adwords_conversion_color_'.$this->request->params['pass'][0]), $element);
	        		$element = str_replace('{{google_conversion_label}}', Configure::read('Seo.adwords_conversion_label_'.$this->request->params['pass'][0]), $element);
	        		$element = str_replace('{{google_conversion_value}}', Configure::read('Seo.adwords_conversion_value_'.$this->request->params['pass'][0]), $element);
					echo $element;
    			}
    			
    		}

        }
    }
/**
 * Before layout callback. Called before the layout is rendered.
 *
 * @return void
 */
    public function beforeLayout($layoutFile) {

		if($this->request->here == '/'){
			$this->view->set('title_for_layout', Configure::read('Seo.homepage_title'));
			//$this->view->viewVars['title_for_layout'] = Configure::read('Seo.homepage_title');
		}
    }
/**
 * After layout callback. Called after the layout has rendered.
 *
 * @return void
 */
    public function afterLayout($layoutFile) {
    }
/**
 * Called after LayoutHelper::setNode()
 *
 * @return void
 */
    public function afterSetNode() {
        // field values can be changed from hooks
    }
/**
 * Called before LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function beforeNodeInfo() {
    }
/**
 * Called after LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function afterNodeInfo() {
    }
/**
 * Called before LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function beforeNodeBody() {
    }
/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function afterNodeBody() {
    }
/**
 * Called before LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function beforeNodeMoreInfo() {
    }
/**
 * Called after LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function afterNodeMoreInfo() {
    }
}
?>
