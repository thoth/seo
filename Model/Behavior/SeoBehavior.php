<?php
/**
 * Seo Behavior
 *
 * PHP version 5
 *
 * @category Behavior
 * @package  Croogo
 * @version  1.0
 * @author   Thomas Rader <thomas.rader@tigerclawtech.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.tigerclawtech.com/portfolio/croogo-seo-plugin
 */
class SeoBehavior extends ModelBehavior {

        /**
         * Nodeattachment model
         *
         * @var object
         */
        private $Seo = null;

        /**
         * Setup
         *
         * @param object $model
         * @param array  $config
         * @return void
         */
        public function setup(Model $model, $config = array()) {
            if (is_string($config)) {
                    $config = array($config);
            }

            $this->settings[$model->alias] = $config;
            
	    	$model->bindModel(
	        	array(
	        		'hasOne'=>array(
	        			'Seo'=>array(
							'className'     => 'Seo',
							'foreignKey'    => 'node_id',
	        			)
	        		)
	        	),
	        	false
	    	);
        }


        /**
         * After find callback
         *
         * @param object $model
         * @param array $results
         * @param boolean $primary
         * @return array
         */
         public function  afterFind(Model $model, $results, $primary = false) {
                parent::afterFind($model, $results, $primary);

                if ($model->name != 'Seo') {
                        if ($primary && isset($results[0][$model->alias])) {
                            foreach ($results AS $i => $result) {
                                if (isset($results[$i][$model->alias]['title'])) {
                                    $results[$i]['Seo'] = $this->_getSeo($model, $result[$model->alias]['id']);
                                }
                            }
                        } elseif (isset($results[$model->alias])) {
                            if (isset($results[$model->alias]['title'])) {
                                $results['Seo'] = $this->_getSeo($model, $results[$model->alias]['id']);
                            }
                        }
                }
                return $results;

        }

        /**
         * Get all attachments for node
         *
         * @param object $model
         * @param integer $nodeid
         * @return array
         */
        private function _getSeo(Model $model, $node_id) {
            if (!is_object($this->Seo)) {
            	$this->Seo = ClassRegistry::init('Seo.Seo');
            }

            // unbind unnecessary models from Node model
            $model->unbindModel(array(
                'belongsTo' => array('User'),
                'hasMany' => array('Comment', 'Meta'),
                'hasAndBelongsToMany' => array('Taxonomy')
            ));
            
            $model->recursive = 0;
            
            App::import('Model', 'Seo.Seo');
            $seomodel = new Seo();

            $seos = $seomodel->find('first', array(
                'conditions' => array('Seo.node_id' => $node_id)
            ));
            if(count($seos)> 0){
                return $seos['Seo'];            
            } else {
            	return null;
            }

        }


}
?>
