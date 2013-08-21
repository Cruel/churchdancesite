<h2 class="text-center"><?php echo __('Songs Pending Approval'); ?></h2>
	<table class="table table-striped">
	<?php foreach ($songs as $song): ?>
	<tr>
		<td>
		<?php
			echo $this->Html->link(__('Listen').' <span class="glyphicon glyphicon-headphones"></span>',
					$song['Song']['music'],
					array(
							'class'=> 'btn btn-xs btn-info',
							'escape'=> false,
					)
			);
			echo "&nbsp;";
			echo $this->Html->link($song['Song']['title'], $song['Song']['lyrics']);
		?>
		</td>
		<td><?php echo h($song['Song']['artist']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($song['User']['username'], array('plugin'=>null, 'controller' => 'users', 'action' => 'view', 'admin'=>false, $song['User']['slug'])); ?>
		</td>
		<td class="text-right">
			<?php 
				echo $this->Html->link(__('Edit').' <span class="glyphicon glyphicon-pencil"></span>',
						array('action' => 'edit', $song['Song']['id']),
						array(
								'class'=> 'btn btn-xs btn-default',
								'escape'=> false,
						)
				);
				echo "&nbsp;";
				echo $this->Html->link(__('Approve').' <span class="glyphicon glyphicon-ok"></span>',
					array('action' => 'approve', $song['Song']['id']),
					array(
						'class'=> 'btn btn-xs btn-success',
						'escape'=> false,
					)
				);
				echo "&nbsp;";
				echo $this->Form->postLink(__('Delete').' <span class="glyphicon glyphicon-remove"></span>',
					array('action' => 'delete', $song['Song']['id']),
					array(
						'class'=> 'btn btn-xs btn-danger',
						'escape'=> false,
					),
					__('Are you sure you want to delete # %s?', $song['Song']['title'])
				);
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
