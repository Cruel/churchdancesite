<?php
App::uses('UsersController', 'Users.Controller');

class MyUsersController extends UsersController {
	
	public $name = 'MyUsers';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->User = ClassRegistry::init('MyUser');
		$this->set('model', 'MyUser');
	}
	
	protected function _setupAuth() {
		parent::_setupAuth();
	
		$this->Auth->loginAction = array('plugin'=>null, 'controller'=>'my_users', 'action'=>'login');
		$this->Auth->loginRedirect = '/';
		$this->Auth->logoutRedirect = '/login';
	}
	
	public function login() {
		parent::login();
		if ($this->Auth->loggedIn()) {
			$this->Session->write('Profile', $this->{$this->modelClass}->UserDetail->getSection($this->Auth->user('id'), 'User'));
		}
		
	}
	
	public function add() {
		$this->{$this->modelClass}->setupDetail();
		parent::add();
	}
	
	public function edit() {
		$this->{$this->modelClass}->setupDetail();
		$this->modelClass = 'User';
		parent::edit();
// 		if ($this->Auth->loggedIn()) {
// 			$this->Session->write('Profile', $this->{$this->modelClass}->UserDetail->getSection($this->Auth->user('id'), 'User'));
// 		}
	}

	public function admin_edit($id = null) {
		if (!$this->{$this->modelClass}->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->{$this->modelClass}->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'alert', array('class'=>'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alert', array('class'=>'alert-danger'));
			}
		} else {
			$options = array('conditions' => array($this->modelClass.'.' . $this->{$this->modelClass}->primaryKey => $id));
			$this->request->data = $this->{$this->modelClass}->find('first', $options);
		}
	}
	
	public function admin_export(){
		Configure::write('debug',0);
	
		$data = $this->{$this->modelClass}->find(
				'all',
				array(
						'fields' => array('id','title','artist','music','lyrics'),
						'order' => "Song.title ASC",
						'contain' => false,
						'conditions' => array('Song.approved' => true),
				));
		// Define column headers for CSV file, in same array format as the data itself
		$headers = array(
				'Song'=>array(
						'id' => 'ID',
						'title' => 'Song',
						'artist' => 'Artist',
						'music' => 'Music URL',
						'lyrics' => 'Lyrics URL'
				)
		);
		// Add headers to start of data array
		array_unshift($data,$headers);
		// Make the data available to the view (and the resulting CSV file)
		$this->set(compact('data'));
	}
	
}