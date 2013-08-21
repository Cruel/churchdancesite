<?php
App::uses('AppModel', 'Model');
/**
 * Song Model
 *
 * @property User $User
 */
class Song extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'artist' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lyrics' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'music' => array(
				'notempty' => array(
						'rule' => array('notempty'),
						//'message' => 'Your custom message here',
						//'allowEmpty' => false,
						//'required' => false,
						//'last' => false, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		'user_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function beforeRate($data){
		// Only accept ratings of -1, 1, or 0 (cancel)
// 		die(var_dump($data));
		if (!in_array($data['value'], array('1','-1')))
			die("Invalid rating value.");
	}
	
	public function afterRate($data){
		// Only accept ratings of -1, 1, or 0 (cancel)
		$this->cacheRatingStatistics($data);
// 		die(var_dump($data));
	}
	
	public function getRatings($foreignKey, $userId) {
		$findMethod = 'first';
		if (is_array($foreignKey)) {
			$findMethod = 'all';
		}
	
		$entry = $this->Rating->find($findMethod, array(
				'recursive' => -1,
				'conditions' => array(
						'Rating.foreign_key' => $foreignKey,
						'Rating.user_id' => $userId,
						'Rating.model' => $this->alias
				)
		));
	
		if ($findMethod == 'all') {
			return Hash::combine($entry, '{n}.Rating.foreign_key', '{n}.Rating.value');
		}
		if (empty($entry)) {
			return false;
		}
		return $entry;
	}
	
	public function updatePending(){
		$pendingcount = $this->find('count', array(
				'conditions' => array('Song.approved' => false)
		));
		Configure::write('Settings.pendingcount', $pendingcount);
		Configure::dump('settings.php', 'default', array('Settings'));
	}
}
