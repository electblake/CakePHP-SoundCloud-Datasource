<?php
App::uses('ApisResult', 'SoundCloud.Model');
/**
 * SourcesSoundcloud Model
 *
 * @property Source $Source
 * @property Track $Track
 */
class SoundcloudResult extends ApisResult {

 /**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
	public $useTable = 'soundcloud_results';

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
	
	
  # object => source
  public $track_map = array(
    'title' => 'title',
  );
	
	public function beforeSave($options = array()) {
	 
	 if (is_array($this->data)) {
      $track_source = $this->data['SoundcloudResult'];
      
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
        if (isset($track_source[$expand_field]) and is_array($track_source[$expand_field])) {
          foreach ($track_source[$expand_field] as $name => $val) {
            $track_source['source_'.$expand_field.'_'.$name] = $val;
            unset($track_source[$expand_field][$name]);
          }
          unset($track_source[$expand_field]); 
        }
      }

      $this->data['SoundcloudResult'] = $track_source;
      
  }
 }
 
 /*
public function afterSave($created) {
   
   #$this->Track->read(null, $this->Track->id);
   if (is_array($this->data) and is_array($this->track_map)) {
      foreach ($this->track_map as $track_field => $source_field) {
        $source_data = $this->data['SoundcloudResult'][$source_field];
        $this->Track->set($track_field, $source_data);
      }
      $this->Track->save();
   }
   
 }
*/
 
}
