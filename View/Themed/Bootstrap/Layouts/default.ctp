<?php
$siteDescription = __d('ldsdj_dev', 'Stake Dance');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteDescription; ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive.min');
		echo $this->Html->css('bootstrap-glyphicons');
		echo $this->Html->css('main');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('vendor/modernizr-2.6.2-respond-1.1.0.min');
	?>

</head>
<body>
	<!--[if lt IE 7]>
		<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->
	
	<div id="wrap">
		<?php echo $this->element("navbar") ?>
	
		<div class="container">
	
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
	
		</div> <!-- /container -->
	</div> <!-- /wrap -->
	
    <div id="footer">
      <div class="container">
        <p class="text-muted credit text-center">This is not an official website of the Church of Jesus Christ of Latter-Day Saints.</p>
      </div>
    </div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
	<?php echo $this->Html->script('vendor/bootstrap.min'); ?>
	<?php echo $this->Html->script('main'); ?>
</body>
</html>
