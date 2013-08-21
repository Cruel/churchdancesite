<h3 class="text-center"><?php echo __('Settings'); ?></h3>
<?php
	echo $this->Form->create(null, array(
				'inputDefaults' => array(
					//'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'class' => 'form-control',
					'div' => array('class' => 'form-group'),
					'between' => '<div class="col-lg-4">',
					'after' => '</div>',
				),
				'class' => 'form-horizontal'
		));
	echo $this->Form->input('Settings.home_content', array(
			'type'=>'textarea',
			'label' => array(
					'text' => __('Homepage HTML'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			)));
	
	echo $this->Form->input('Settings.presidency_email', array(
			'label' => array(
					'text' => __('Presidency Email'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			)));

	echo $this->Form->input('Settings.enable_dj', array(
			'type'=>'checkbox',
			'class'=>'', 'between'=>'', 'after'=>'',
// 			'div'=>'col-lg-3 col-lg-offset-2',
			'label' => array(
					'text' => __('Enable DJ Interact'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			)));
	echo $this->Form->input('Settings.dj', array(
			'label' => array(
					'text' => __('DJ Name'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			)));
	echo $this->Form->input('Settings.dj_email', array(
			'label' => array(
					'text' => __('DJ Email'),
					'class'=> 'col-lg-2 col-lg-offset-2 control-label'
			)));
	echo $this->Form->end(array(
			'div' => 'col-lg-3 col-lg-offset-5',
			'label' => __('Save'),
			'class' => 'btn btn-primary btn-lg btn-block'
	));
?>