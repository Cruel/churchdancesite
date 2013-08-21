<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('display');
	}


/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
	public function admin_settings() {
		if (empty($this->request->data)) {
			$this->request->data['Settings'] = Configure::read('Settings');
		} else {
			$settings = Configure::read('Settings');
			$this->request->data['Settings']['pendingcount'] = $settings['pendingcount'];
			Configure::write('Settings', $this->request->data['Settings']);
			Configure::dump('settings.php', 'default', array('Settings'));
			$this->Session->setFlash(__('Settings saved.'), 'alert', array('class'=>'alert-info'));
		}
		
		$this->render('/Admin/settings');
	}
	
	public function email($message = null){
		$user = $this->Auth->user();
		if (!$user || $message == null){
			$this->Session->setFlash(__('You need to be logged in to interact with the DJ.'), 'alert', array('class'=>'alert-danger'));
			$this->redirect('/');
		}
		$settings = Configure::read('Settings');
		$mail = new CakeEmail();
		$mail->config('default')
		     ->from(array($user['email'] => $user['username']))
		     ->replyTo(array($user['email'] => $user['username']))
		     ->to($settings['dj_email'])
		     ->subject($message)
		     ->send($message);
		$this->Session->setFlash(__('Message successfully sent to the DJ!'), 'alert', array('class'=>'alert-success'));
		$this->redirect('/');
	}
}
