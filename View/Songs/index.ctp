<div class="songs index">
	<h2><?php echo __('Songs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('artist'); ?></th>
			<th><?php echo $this->Paginator->sort('lyrics'); ?></th>
			<th><?php echo $this->Paginator->sort('approved'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($songs as $song): ?>
	<tr>
		<td><?php echo h($song['Song']['id']); ?>&nbsp;</td>
		<td><?php echo h($song['Song']['title']); ?>&nbsp;</td>
		<td><?php echo h($song['Song']['artist']); ?>&nbsp;</td>
		<td><?php echo h($song['Song']['lyrics']); ?>&nbsp;</td>
		<td><?php echo h($song['Song']['approved']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($song['User']['id'], array('controller' => 'users', 'action' => 'view', $song['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $song['Song']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $song['Song']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $song['Song']['id']), null, __('Are you sure you want to delete # %s?', $song['Song']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Song'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
