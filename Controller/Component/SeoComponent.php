<?php
/**
 * Seo Component
 *
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.tigerclawtech.com
 */
class SeoComponent extends Component {
/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object $controller Controller with components to startup
 * @return void
 */
 	var $controller;
	
	function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
    }

	/**
	 * Initialize Controller - called before Controller::beforeFilter()
	 *
	 * @param object $controller
	 */
	function initialize(Controller $controller) {
		// saving the controller reference for later use
		$this->controller =& $controller;

		$this->Seo = ClassRegistry::init('Seo.Seo');

		

	}
 
    public function startup(Controller $controller) {
        //$controller->set('exampleComponent', 'ExampleComponent startup');
        $this->controller =& $controller;
    }
/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object $controller Controller with components to beforeRender
 * @return void
 */
    public function beforeRender(Controller $controller) {
     	
    	//check to see if we are doing RSS
//debug($controller); exit();    	
    	if(array_key_exists('ext', $controller->request->params) && $controller->request->params['ext'] == 'rss'){

    		if(array_key_exists('nodes', $controller->viewVars)){
    			foreach($controller->viewVars['nodes'] as $index=>$node){
    				if(strlen(Configure::read('Seo.rss_before')) > 0){
    					$controller->viewVars['nodes'][$index]['Node']['body'] = '<p>'.$this->replaceTokens(Configure::read('Seo.rss_before')).'</p>'.$controller->viewVars['nodes'][$index]['Node']['body'];
    				}
    				if(strlen(Configure::read('Seo.rss_after')) > 0){
    					$controller->viewVars['nodes'][$index]['Node']['body'] = $controller->viewVars['nodes'][$index]['Node']['body'].'<p>'.$this->replaceTokens(Configure::read('Seo.rss_after')).'</p>';
    				}
    			}
    		}
    	}
    }
/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * @param object $controller Controller with components to shutdown
 * @return void
 */
    public function shutdown(Controller $controller) {
    }
    
    private function replaceTokens($string){
    	//do specific tag replacements
  		//debug($this->controller); exit();
    	
    	//grab the link builder from HtmlHelper
    	App::import('Helper', 'Html');
    	$htmlhelper = new HtmlHelper();
    	
    	
    	$campaign_tracker = '';
    	if(strlen(Configure::read('Seo.add_copy_link_rss_campaign_tags'))>0){
        	$campaign_tracker = '?utm_medium='.Configure::read('Seo.copy_link_rss_medium').'&utm_campaign='.Configure::read('Seo.copy_link_rss_campaign');
    	}
    	$string = str_replace('{{current_page}}', $htmlhelper->link('http://'.$_SERVER['SERVER_NAME'].$this->controller->here.$campaign_tracker, 'http://'.$_SERVER['SERVER_NAME'].$this->controller->here.$campaign_tracker), $string);
    	$string = str_replace('{{website}}', $htmlhelper->link('http://'.$_SERVER['SERVER_NAME'].$campaign_tracker,'http://'.$_SERVER['SERVER_NAME'].$campaign_tracker), $string);
    	$string = str_replace('{{page_title}}', $this->controller->viewVars['title_for_layout'], $string);
    	$string = str_replace('{{site_title}}', Configure::read('Site.title'), $string);
    	$string = str_replace('{{year}}', date('Y'), $string);
    	$string = str_replace('{{month}}', date('m'), $string);
    	$string = str_replace('{{monthname}}', date('F'), $string);
    	$string = str_replace('{{day}}', date('d'), $string);
    	return($string);
    }
    
}
?>
