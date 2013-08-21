<h2 class="text-center"><?php echo __('Please sign in'); ?></h2>
<?php
	echo $this->Form->create('MyUser', array(
			'action' => 'login',
			'inputDefaults' => array(
					'class' => 'form-control',
					'label' => false,
					'div'=>'col-lg-4 col-lg-offset-4 form-group'
			),
	));
	echo $this->Form->input('email', array('placeholder' => 'Email address'));
	echo $this->Form->input('password', array('placeholder' => 'Password'));
	echo '<p>' . $this->Form->input('remember_me', array('type' => 'checkbox', 'label' =>  __d('users', 'Remember Me'), 'class'=>'', 'div'=>'col-lg-4 col-lg-offset-4')) . '</p>';
	echo $this->Form->end(array(
			'label' => __('Sign in'),
			'class' => 'btn btn-lg btn-primary btn-block',
			'div' => 'col-lg-4 col-lg-offset-4',
	));
	
?>
