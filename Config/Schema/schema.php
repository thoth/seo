<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-06-06 02:06:57 : 1275792417*/
class SeoSchema extends CakeSchema {
	var $name = 'Seo';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var	$seos = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'node_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'meta_keywords' => array('type' => 'text', 'null' => true),
			'meta_description' => array('type' => 'text', 'null' => true),
			'meta_robots' => array('type' => 'text', 'null' => true),
			'changefreq' => array('type' => 'string', 'null' => true, 'length'=>25),
			'priority' => array('type' => 'text', 'null' => true, 'length'=>25),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
			'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
		); 
}
?>