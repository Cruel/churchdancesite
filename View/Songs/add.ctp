<div class="songs form">
<?php echo $this->Form->create('Song'); ?>
	<fieldset>
		<legend><?php echo __('Add Song'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('artist');
		echo $this->Form->input('lyrics');
		echo $this->Form->input('approved');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Songs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
