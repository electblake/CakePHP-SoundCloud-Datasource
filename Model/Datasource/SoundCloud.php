<?php
/**
 * SoundCloud API Datasource
 *
 * Integrate with the soundcloud API, primarily for use grabbing tracks
 *
 * @package Datasource
 * @author Blake Edwards (electblake@gmail.com)
 **/
App::uses('ApisSource', 'Apis.Model/Datasource');
App::uses('Result', 'SoundCloud.Model');

/* App::uses('HttpSocket', 'Network/Http'); */

class SoundCloud extends ApisSource {

/**
 * The description of this data source
 *
 * @var string
 */
	public $description = 'SoundCloud Api DataSource';
	
/**
 * Holds the datasource configuration
 *
 * @var array
 */
	public $config = array();
	
 /**
 * Holds a configuration map
 *
 * @var array
 */
	//public $map = array();
	
	// TODO: Relocate to a dedicated schema file
	var $_schema = array();
	
  /**
   * API options
   * @var array
   */
	public $options = array(
	  'format' => 'json',
  );
  
 /**
 * Just-In-Time callback for any last-minute request modifications
 *
 * @param object $model
 * @param array $request
 * @return array $request
 */
	public function beforeRequest(&$model, $request) {
    
    $format = $this->options['format'] ? $this->options['format'] : 'fail';
    
    $request['header']['Accept'] = 'application/'.$format;
    $request['redirect'] = true;
    
    $request['uri']['query']['client_id'] = $this->config['client_id'];
	  
		return $request;
	}
	
/**
 * Uses standard find conditions. Use find('all', $params). Since you cannot pull specific fields,
 * we will instead use 'fields' to specify what table to pull from.
 *
 * @param string $model The model being read.
 * @param string $queryData An array of query data used to find the data you want
 * @return mixed
 * @access public
 */
/*
	public function read(&$model, $queryData = array()) {
	 
	  Debug($queryData);
		// $this->tokens = $queryData['conditions']; // Swap out tokens for passed conditions
		return parent::read($model, $queryData);
	}
*/
}