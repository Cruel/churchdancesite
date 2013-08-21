<?php
App::uses('User', 'Users.Model');
class MyUser extends User {
	
	public $useTable = 'users';
	
	public $validate = array(
			'username' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'required' => true, 'allowEmpty' => false,
							'message' => 'Please enter a username.'),
					'alpha' => array(
							'rule' => array('custom', '/[A-Z][a-z]+ [A-Z][a-z]+/'),
							'message' => 'Your name must be alphanumeric with proper format: "First Last".'),
					'unique_username' => array(
							'rule' => array('isUnique', 'username'),
							'message' => 'This username is already in use.'),
					'username_min' => array(
							'rule' => array('minLength', '3'),
							'message' => 'The username must have at least 3 characters.')),
			'email' => array(
					'isValid' => array(
							'rule' => 'email',
							'required' => true,
							'message' => 'Please enter a valid email address.'),
					'isUnique' => array(
							'rule' => array('isUnique', 'email'),
							'message' => 'This email is already in use.')),
			'password' => array(
					'too_short' => array(
							'rule' => array('minLength', '6'),
							'message' => 'The password must have at least 6 characters.'),
					'required' => array(
							'rule' => 'notEmpty',
							'message' => 'Please enter a password.')),
			'ward' => array(
					'required' => array(
							'rule' => 'notEmpty',
							'message' => 'You need to enter Ward and Stake.')),
			'stake' => array(
					'required' => array(
							'rule' => 'notEmpty',
							'message' => 'You need to enter Ward and Stake.')),
			'temppassword' => array(
					'rule' => 'confirmPassword',
					'message' => 'The passwords are not equal, please try again.'),
			'tos' => array(
					'rule' => array('custom','[1]'),
					'message' => 'You must agree to the terms of use.'));

// Profile sync on registration
// 	public function register($postData = array(), $options = array()) {
// 		$data = parent::register($postData, array('returnData'=>true));
// 		if ($data){
// 			$details = array();
// 			$details['UserDetail']['ward'] = $postData['MyUser']['ward'];
// 			$details['UserDetail']['stake'] = $postData['MyUser']['stake'];
// 			$this->UserDetail->saveSection($data['MyUser']['id'], $details, 'User');
// 			return true;
// 		}
// 		return false;
// 	}
}