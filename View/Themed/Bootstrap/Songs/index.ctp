<?php $settings = Configure::read('Settings'); ?>
<h2 class="text-center"><?php echo __('Song List'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('title', 'Song <span class="glyphicon glyphicon-sort-by-alphabet"></span>', array('escape'=>false, 'class'=>'btn btn-lg')); ?></th>
			<th><?php echo $this->Paginator->sort('artist', 'Artist <span class="glyphicon glyphicon-sort-by-alphabet"></span>', array('escape'=>false, 'class'=>'btn btn-lg')); ?></th>
			<th><?php echo $this->Paginator->sort('rating', 'Rating <span class="glyphicon glyphicon-sort-by-attributes"></span>', array('escape'=>false, 'class'=>'btn btn-lg')); ?></th>
			<th class="text-right"></th>
	</tr>
	<?php foreach ($songs as $song): ?>
	<tr>
		<td><?php echo h($song['Song']['title']); ?>&nbsp;</td>
		<td><?php echo h($song['Song']['artist']); ?>&nbsp;</td>
		<td>
		<?php 
			$rating = 0;
			if (isset($rated, $rated[$song['Song']['id']]))
				$rating = (int) $rated[$song['Song']['id']];		
			
			echo $this->element("thumbsrating", array(
				'rated' => $rating,
				'url' => array_merge($this->passedArgs, array('rate' => $song['Song']['id'], 'redirect' => true)),
				'rating_1' => $song['Song']['rating_1'],
				'rating_neg1' => $song['Song']['rating_neg1'],
				'rating' => $song['Song']['rating'],
			));

			?>

		</td class="text-right">
		<td>
		<div class="btn-group">
				<button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
				  Actions <span class="glyphicon glyphicon-chevron-down"></span>
				 </button>
				  <ul class="dropdown-menu">
				  	<li><?php echo $this->Html->link(__('Listen').' <span class="glyphicon glyphicon-headphones pull-right"></span>', $song['Song']['music'], array('escape'=> false, 'target'=>'_blank')); ?></li>
				  	<li><?php echo $this->Html->link(__('Lyrics').' <span class="glyphicon glyphicon-music pull-right"></span>', $song['Song']['lyrics'], array('escape'=> false, 'target'=>'_blank')); ?></li>
				    <?php
				    	if ($this->Session->read('Auth.User.id')){
							echo '<li class="divider"></li>';
					    	if ($settings['enable_dj']) {
								echo "<li>";
						    	echo $this->Html->link(__('Dedicate').' <span class="glyphicon glyphicon-glass pull-right"></span>', "#dedicate", array(
						    		'escape' => false,
						    		'data-toggle' => "modal",
						    		'data-id' => $song['Song']['id'],
						    		'data-songtitle' => $song['Song']['title'],
						    		'class' => 'dedicate',
								));
								echo "</li>";
							}
							echo "<li>";
							echo $this->Html->link(__('Report').' <span class="glyphicon glyphicon-flag pull-right"></span>', "#report", array(
					    		'escape' => false,
					    		'data-toggle' => "modal",
					    		'data-id' => $song['Song']['id'],
					    		'data-songtitle' => $song['Song']['title'],
					    		'class' => 'report',
							));
							echo "</li>";
						}
					?>
				    <?php if ($this->Session->read('Auth.User.is_admin')): ?>
				    	<li class="divider"></li>
				    	<li><?php echo $this->Html->link(__('Edit').' <span class="glyphicon glyphicon-pencil pull-right"></span>', array('action'=>'edit', 'admin'=>true, $song['Song']['id']), array('escape'=> false)); ?></li>
				    	<li><?php echo $this->Form->postLink(__('Delete').' <span class="glyphicon glyphicon-remove pull-right"></span>', array('action'=>'delete', 'admin'=>true, $song['Song']['id']), array('escape'=> false),
				    		__('Are you sure you want to delete this song?')); ?></li>
				    <?php endif; ?>
				  </ul>
				  </div>
		<?php
			
				  
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
	
<?php 
	echo $this->Form->create("Song", array(
		'action' => 'dedicate',
		'inputDefaults' => array(
				'class' => 'form-control',
				'label' => false,
		),
	));
?>
  <div class="modal fade" id="dedicate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Dedicate Song</h4>
        </div>
        <div class="modal-body">
        <div class="well SongTitle"></div>
		<?php
			echo $this->Form->input('message', array('placeholder' => 'Enter your dedication message.', 'type'=>'textarea', 'required'));
			echo $this->Form->hidden('id', array('class'=>'SongId'));
		?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <?php echo $this->Form->button(__('Dedicate'), array('class' => 'btn btn-lg btn-primary'));?>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php 
	echo $this->Form->end();
?>

<?php 
	echo $this->Form->create("Song", array(
		'action' => 'report',
		'inputDefaults' => array(
				'class' => 'form-control',
				'label' => false,
		),
	));
?>
  <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Report Song</h4>
        </div>
        <div class="modal-body">
        <div class="well SongTitle"></div>
		<?php
			echo $this->Form->input('message', array('placeholder' => 'Please explain why this song is inappropriate so it can be reviewed.', 'type'=>'textarea', 'required'));
			echo $this->Form->hidden('id', array('class'=>'SongId'));
		?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <?php echo $this->Form->button(__('Report'), array('class' => 'btn btn-lg btn-danger'));?>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php 
	echo $this->Form->end();
?>
