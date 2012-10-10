<?php
App::uses('AppModel', 'Model');
/**
 * SourcesSoundcloud Model
 *
 * @property Source $Source
 * @property Track $Track
 */
class ApisResult extends AppModel {

/**
 * Display field
 *
 * @var string
 */
 
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
}
