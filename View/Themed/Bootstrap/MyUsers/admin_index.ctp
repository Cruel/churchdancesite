<h2 class="text-center"><?php echo __d('users', 'Users'); ?></h2>

<h3><?php echo __d('users', 'Filter'); ?></h3>
	<?php 
		echo $this->Form->create($model, array(
				'inputDefaults' => array(
						'class' => 'form-control',
						'label' => false,
						'div'=>'col-lg-2 form-group'
				),
		));
		echo $this->Form->input('username', array('placeholder' => __d('users', 'Username')));
		echo $this->Form->input('email', array('placeholder' => __d('users', 'Email')));
		echo $this->Form->end(array(
			'class' => 'btn btn-default',
			'label' => __d('users', 'Search'),
		));
	?>


	<?php
		if ($this->Paginator->hasPage(2)) {
			echo '<ul class="pagination pagination-lg">';
			echo $this->Paginator->prev('&laquo; Prev', array('tag'=>'li', 'escape'=>false), null, array('tag'=>'li', 'escape'=>false, 'class' => 'disabled', 'disabledTag'=>'a'));
			echo $this->Paginator->numbers(array('tag'=>'li', 'separator' => '', 'currentTag'=>'a', 'currentClass'=>'active'));
			echo $this->Paginator->next('Next &raquo;', array('tag'=>'li', 'escape'=>false), null, array('tag'=>'li', 'escape'=>false, 'class' => 'disabled', 'disabledTag'=>'a'));
			echo '</ul>';
		}
	?>
	<table class="table table-striped">
		<tr>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('email_verified'); ?></th>
			<th><?php echo $this->Paginator->sort('is_admin'); ?></th>
			<th class="actions"><?php echo __d('users', 'Actions'); ?></th>
		</tr>
			<?php
			$i = 0;
			foreach ($users as $user):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td>
					<?php echo $user[$model]['username']; ?>
				</td>
				<td>
					<?php echo $user[$model]['email']; ?>
				</td>
				<td>
					<?php echo $user[$model]['email_verified'] == 1 ? __d('users', 'Yes') : __d('users', 'No'); ?>
				</td>
				<td>
					<?php echo $user[$model]['is_admin'] == 1 ? __d('users', 'Yes') : __d('users', 'No'); ?>
				</td>
				<td class="actions">
					<?php
						echo $this->Html->link(__d('users', 'Edit').' <span class="glyphicon glyphicon-pencil"></span>', array('action'=>'edit', $user[$model]['id']), array(
							'class' => 'btn btn-xs btn-default',
							'escape' => false,
						));
						echo $this->Html->link(__d('users', 'Delete').' <span class="glyphicon glyphicon-remove"></span>', array('action'=>'delete', $user[$model]['id']), array(
							'class' => 'btn btn-xs btn-default',
							'escape' => false,
						), sprintf(__d('users', 'Are you sure you want to delete # %s?'), $user[$model]['username']));
// 						echo $this->Html->link(__('Make Admin').' <span class="glyphicon glyphicon-star-empty"></span>', array('action'=>'makeadmin', $user[$model]['id']), array(
// 								'class' => 'btn btn-xs btn-default',
// 								'escape' => false,
// 						), sprintf(__('Are you sure you want to make %s an admin?'), $user[$model]['username']));
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php
		if ($this->Paginator->hasPage(2)) {
			echo '<ul class="pagination pagination-lg">';
			echo $this->Paginator->prev('&laquo; Prev', array('tag'=>'li', 'escape'=>false), null, array('tag'=>'li', 'escape'=>false, 'class' => 'disabled', 'disabledTag'=>'a'));
			echo $this->Paginator->numbers(array('tag'=>'li', 'separator' => '', 'currentTag'=>'a', 'currentClass'=>'active'));
			echo $this->Paginator->next('Next &raquo;', array('tag'=>'li', 'escape'=>false), null, array('tag'=>'li', 'escape'=>false, 'class' => 'disabled', 'disabledTag'=>'a'));
			echo '</ul>';
		}
	?>

