<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Songs Controller
 *
 * @property Song $Song
 * @property PaginatorComponent $Paginator
 */
class SongsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'RequestHandler',
		'Ratings.Ratings' => array(
			'update' => true,
		),
		'Paginator',
	);
	
	public $helpers = array('Ratings.Rating');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->unlockedActions = array('dedicate','report');
		$this->Auth->allow('index');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Song->recursive = 0;
		$this->Song->virtualFields = array(
			'rating' => 'rating_1 - rating_neg1'
		);
		$this->Paginator->settings = array(
			'conditions' => array('Song.approved' => true),
			'limit' => 15,
		);
		$songs = $this->Paginator->paginate();
		$user_id = $this->Auth->user('id');
		if ($user_id){
			$keys = Hash::extract($songs, '{n}.Song.id');
			$this->set('rated', $this->Song->getRatings($keys, $user_id));
		}
		$this->set('songs', $songs);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
// 	public function view($id = null) {
// 		if (!$this->Song->exists($id)) {
// 			throw new NotFoundException(__('Invalid song'));
// 		}
// 		$options = array('conditions' => array('Song.' . $this->Song->primaryKey => $id));
// 		$this->set('song', $this->Song->find('first', $options));
// 	}

/**
 * request method
 *
 * @return void
 */
	public function request() {
		if ($this->request->is('post')) {
			$this->Song->create();
			$this->request->data['Song']['user_id'] = $this->Session->read('Auth.User.id');
			if ($this->Song->save($this->request->data)) {
				$this->Session->setFlash(__('The song has been saved'), 'alert', array('class'=>'alert-success'));
				$this->Song->updatePending();
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'), 'alert', array('class'=>'alert-danger'));
			}
		}
		$users = $this->Song->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Song->exists($id)) {
			throw new NotFoundException(__('Invalid song'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Song->save($this->request->data)) {
				$this->Session->setFlash(__('The song has been saved'), 'alert', array('class'=>'alert-success'));
			} else {
				$this->Session->setFlash(__('The song could not be saved. Please, try again.'), 'alert', array('class'=>'alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Song.' . $this->Song->primaryKey => $id));
			$this->request->data = $this->Song->find('first', $options);
		}
		$users = $this->Song->User->find('list',array(
	        'fields' => array('User.username')
	    ));
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Song->id = $id;
		if (!$this->Song->exists()) {
			throw new NotFoundException(__('Invalid song'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Song->delete()) {
			$this->Session->setFlash(__('Song deleted'), 'alert', array('class'=>'alert-success'));
			$this->Song->updatePending();
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Song was not deleted'), 'alert', array('class'=>'alert-danger'));
		$this->redirect($this->referer());
	}
		

	public function admin_pending() {
		$this->Song->recursive = 0;
		$pending = $this->Song->find('all', array(
	        'conditions' => array('Song.approved' => false)
	    ));
		$this->set('songs', $pending);
	}
	
	public function admin_approve($id = null) {
		if (!$this->Song->exists($id)) {
			throw new NotFoundException(__('Invalid song'));
		}
		$song = $this->Song->read(null, $id);
		$this->Song->set('approved', 1);
		$this->Song->save();
		$this->Session->setFlash(__('"%s" has been approved.', $song['Song']['title']), 'alert', array('class'=>'alert-success'));
		$this->Song->updatePending();
		$this->redirect(array('action' => 'pending'));
		
	}
	
	public function admin_export(){
		Configure::write('debug',0);

		$data = $this->Song->find(
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
	
	public function dedicate(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$id = $this->request->data['Song']['id'];
			$message = $this->request->data['Song']['message'];
			$user = $this->Auth->user();
			if (!empty($message) && $user){
				if (!$this->Song->exists($id)) {
					throw new NotFoundException(__('Invalid song'));
				}
				$this->Song->recursive = 0;
				$song = $this->Song->read(null, $id);
				$message = "From: ".$user['username']."\nSong: ".$song['Song']['title']." - ".$song['Song']['artist']."\n\nMessage: ".$message;
				$settings = Configure::read('Settings');
				$mail = new CakeEmail();
				$mail->config('default')
				     ->from(array($user['email'] => $user['username']))
				     ->replyTo(array($user['email'] => $user['username']))
				     ->to($settings['dj_email'])
				     ->subject("Song Dedication Request")
				     ->send($message);
				$this->Session->setFlash(__('"%s" has submitted for dedication.', $song['Song']['title']), 'alert', array('class'=>'alert-success'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}
	
	public function report(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$id = $this->request->data['Song']['id'];
			$message = $this->request->data['Song']['message'];
			$user = $this->Auth->user();
			if (!empty($message) && $user){
				if (!$this->Song->exists($id)) {
					throw new NotFoundException(__('Invalid song'));
				}
				$this->Song->recursive = 0;
				$song = $this->Song->read(null, $id);
				$message = "From: ".$user['username']."\nSong: ".$song['Song']['title']." - ".$song['Song']['artist']."\n\nMessage: ".$message;
				$settings = Configure::read('Settings');
				$mail = new CakeEmail();
				$mail->config('default')
				     ->from(array($user['email'] => $user['username']))
				     ->replyTo(array($user['email'] => $user['username']))
				     ->to($settings['presidency_email'])
				     ->subject("Song Report")
				     ->send($message);
				$this->Session->setFlash(__('"%s" has been reported and will be reviewed. Thanks for your help.', $song['Song']['title']), 'alert', array('class'=>'alert-success'));
			}
		}
		$this->redirect(array('action' => 'index'));
	}
	
}
