<div class="btn-group">
<?php 
	echo $this->Html->link('Like <span class="glyphicon glyphicon-thumbs-up"></span>',
		array_merge($url, array('rating'=>1)),
		array(
			'escape' => false,
			'class' => "btn btn-". (($rated===1) ? 'success' : 'default') ." btn-xs",
		)
	);
	echo $this->Html->div("btn btn-xs btn-default", $rating, array(
		'data-toggle' => 'tooltip',
		'data-original-title' => "$rating_1 Likes<br/>$rating_neg1 Dislikes",
		'data-html' => 'true',
		'data-container' => 'body',
	));
	echo $this->Html->link('Dislike <span class="glyphicon glyphicon-thumbs-down"></span>',
			array_merge($url, array('rating'=>-1)),
			array(
					'escape' => false,
					'class' => "btn btn-". (($rated===-1) ? 'danger' : 'default') ." btn-xs",
			)
	);
?>
</div>