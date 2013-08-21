<?php 
$settings = Configure::read('Settings');
if (!$settings['enable_dj']) {
	echo $settings['home_content'];
} else {
?>

<h2 class="text-center">Interact with DJ</h2>
<div class="col-lg-4 col-lg-offset-4">
<?php
	$msg = "Love this song!";
	echo $this->Html->link(__("Love this song!").' <span class="glyphicon glyphicon-thumbs-up"></span>', array('plugin'=>null, 'action'=>'email', 'admin'=>false, $msg), array(
		'class' => 'btn btn-lg btn-success btn-block',
		'escape' => false
	));
	$msg = "Drop this song!";
	echo $this->Html->link(__("Drop this song!").' <span class="glyphicon glyphicon-thumbs-down"></span>', array('plugin'=>null, 'action'=>'email', 'admin'=>false, $msg), array(
		'class' => 'btn btn-lg btn-danger btn-block',
		'escape' => false
	));
	$msg = "Turn up the volume.";
	echo $this->Html->link(__("Turn up the volume").' <span class="glyphicon glyphicon-volume-up"></span>', array('plugin'=>null, 'action'=>'email', 'admin'=>false, $msg), array(
			'class' => 'btn btn-lg btn-default btn-block',
			'escape' => false
	));
	$msg = "Turn down the volume.";
	echo $this->Html->link(__("Turn down the volume").' <span class="glyphicon glyphicon-volume-down"></span>', array('plugin'=>null, 'action'=>'email', 'admin'=>false, $msg), array(
			'class' => 'btn btn-lg btn-default btn-block',
			'escape' => false
	));
	$msg = "Thank you for your service tonight!";
	echo $this->Html->link(__("Thank you for your service!").' <span class="glyphicon glyphicon-heart"></span>', array('plugin'=>null, 'action'=>'email', 'admin'=>false, $msg), array(
			'class' => 'btn btn-lg btn-info btn-block',
			'escape' => false
	));
?>
</div>
	
<?php } ?>