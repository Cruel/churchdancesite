<div class="songs view">
<h2><?php echo __('Song'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($song['Song']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($song['Song']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Artist'); ?></dt>
		<dd>
			<?php echo h($song['Song']['artist']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lyrics'); ?></dt>
		<dd>
			<?php echo h($song['Song']['lyrics']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approved'); ?></dt>
		<dd>
			<?php echo h($song['Song']['approved']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($song['User']['id'], array('controller' => 'users', 'action' => 'view', $song['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Song'), array('action' => 'edit', $song['Song']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Song'), array('action' => 'delete', $song['Song']['id']), null, __('Are you sure you want to delete # %s?', $song['Song']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Songs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Song'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
