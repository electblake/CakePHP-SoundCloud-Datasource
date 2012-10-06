<?php
App::uses('ApiResult', 'SoundCloud.Model');
/**
 * SourcesSoundcloud Model
 *
 * @property Source $Source
 * @property Track $Track
 */
class SoundCloudResult extends ApiResult {

/**
 * Display field
 *
 * @var string
 */
/*   public $useTable = 'sources_soundclouds'; */
	public $displayField = 'title';
	public $useTable = 'results_soundcloud';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Track' => array(
			'className' => 'Track',
			'foreignKey' => 'track_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	public function beforeSave($options = array()) {
	 
	 if (is_array($this->data)) {
      
      $track_source = $this->data['SoundCloudResult'];
      
      $day = $track_source['release_day'];
      $month = $track_source['release_month'];
      $year = $track_source['release_year'];
      
      $track_source['release_date'] = strtotime($month.'-'.$day.'-'.$year);
      unset($track_source['release_day'], $track_source['release_month'], $track_source['release_year']);      
      
      $booleans = array('streamable', 'downloadable', 'commentable');
      foreach ($booleans as $bool_field) {
        if ($track_source[$bool_field]) {
          $track_source[$bool_field] = 1;
        } else {
          $track_source[$bool_field] = 0;
        }
      }
      
      $times = array('created_at');
      foreach ($times as $time_field) {
        $track_source[$time_field] = strtotime($track_source[$time_field]);
      }
      
      
      $expand_arrays = array('user', 'label');
      foreach ($expand_arrays as $expand_field) {
        foreach ($track_source[$expand_field] as $name => $val) {
          $track_source['source_'.$expand_field.'_'.$name] = $val;
          unset($track_source[$expand_field][$name]);
        }
        unset($track_source[$expand_field]);
      }

      
      $this->data['SoundCloudResult'] = $track_source;
  }
 }
}
