<h2 class="text-center"><?php echo __('Request Song'); ?></h2>
<ol class="well list-group col-lg-4 col-lg-offset-4">
	<li class="list-group-item"><h4 class="list-group-item-heading">All songs should be danceable.</h4> Just because it's fun to listen to doesn't mean we can dance to it.</li>
	<li class="list-group-item"><h4 class="list-group-item-heading">No songs with suggestive lyrics.</h4> There are way too many good songs out there to quibble over something questionable.</li>
	<li class="list-group-item"><h4 class="list-group-item-heading">Fill in all boxes below properly.</h4> It makes it much easier to review and approve.</li>
</ol>
<?php
	echo $this->Form->create('Song', array(
			'inputDefaults' => array(
					'class' => 'form-control',
					'label' => false,
					'div'=>'col-lg-4 col-lg-offset-4 form-group'
			),
	));
	echo $this->Form->input('title', array('placeholder' => 'Song Title'));
	echo $this->Form->input('artist', array('placeholder' => 'Artist Name'));
	echo $this->Form->input('lyrics', array('placeholder' => 'Link to lyrics: (e.g. MetroLyrics, AZLyrics)', 'type'=>'text'));
	echo $this->Form->input('music', array('placeholder' => 'Link to song: (e.g. Youtube)', 'type'=>'text'));
	echo $this->Form->end(array(
			'label' => __('Request'),
			'class' => 'btn btn-lg btn-primary btn-block',
			'div' => 'col-lg-4 col-lg-offset-4',
	));
?>