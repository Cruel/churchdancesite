<h2 class="text-center"><?php echo __d('users', 'Register New Account'); ?></h2>

	<?php
		echo $this->Form->create($model, array(
				'inputDefaults' => array(
					//'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'class' => 'form-control',
					'div' => array('class' => 'form-group'),
					'between' => '<div class="col-lg-4">',
					'after' => '</div>',
				),
				'class' => 'form-horizontal'
		));
		echo $this->Form->input('username', array(
			'label' => array(
					'text' => __('Full Name'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			)));
		echo $this->Form->input('email', array(
			'label' => array(
					'text' => __('E-mail'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			),
// 			'error' => array('isValid' => __d('users', 'Must be a valid email address'),
// 			'isUnique' => __d('users', 'An account with that email already exists'))
			));
// 		echo $this->Form->input('UserDetail.ward');
// 		echo $this->Form->input('UserDetail.stake');
		echo $this->Form->input('ward', array(
				'label' => array(
						'text' => __('Ward'),
						'class'=> 'col-lg-2 col-lg-offset-2 control-label'
				)));
		echo $this->Form->input('stake', array(
				'label' => array(
						'text' => __('Stake'),
						'class'=> 'col-lg-2 col-lg-offset-2 control-label'
				)));
		echo $this->Form->input('password', array(
			'label' => array(
					'text' => __d('users', 'Password'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			),
			'type' => 'password'));
		echo $this->Form->input('temppassword', array(
			'label' => array(
					'text' => __('Repeat Password'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			),
			'type' => 'password'));
// 		echo $this->Form->input('ward', array(
// 				'label' => array(
// 						'text' => __('Ward'),
// 						'class'=> 'col-lg-2 col-lg-offset-2 control-label'
// 				)));
// 		echo $this->Form->input('stake', array(
// 				'label' => array(
// 						'text' => __('Stake'),
// 						'class'=> 'col-lg-2 col-lg-offset-2 control-label'
// 				)));
// 		$tosLink = $this->Html->link(__d('users', 'Terms of Service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
// 		echo $this->Form->input('tos', array(
// 			'label' => array(
// 				'text' => __d('users', 'I have read and agreed to ') . $tosLink,
// 				'class'=> 'col-lg-2 control-label'
// 			)));
		echo $this->Form->end(array(
				'div' => 'col-lg-3 col-lg-offset-5',
				'label' => __d('users', 'Register'),
				'class' => 'btn btn-primary btn-lg btn-block'
		));
	?>
