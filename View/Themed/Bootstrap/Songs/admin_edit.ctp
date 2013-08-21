<div class="songs form">
<?php echo $this->Form->create('Song'); ?>
	<fieldset>
		<legend><?php echo __('Edit Song'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('artist');
		echo $this->Form->input('lyrics');
		echo $this->Form->input('music');
		echo $this->Form->input('approved');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>