<?php $settings = Configure::read('Settings'); ?>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand navlink-icon" href="<?php echo Router::url('/', true); ?>">Stake Dance <span class="musicsprite"></span></a>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo Router::url('/', true); ?>">Home</a></li>
            <li><?php echo $this->Html->link(__('Song List'), array('plugin' => null, 'controller' => 'songs', 'action' => 'index', 'admin'=>false)); ?></li>
            <li><?php echo $this->Html->link(__('Request Song'), array('plugin' => null, 'controller' => 'songs', 'action' => 'request', 'admin'=>false)); ?></li>
            <?php if (!$this->Session->read('Auth.User.id')): ?>
            	<li><a href="<?php echo Router::url('/login', true); ?>">Login</a></li>
            <?php endif; ?>
            <?php if ($this->Session->read('Auth.User.is_admin')): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(__('User List'), array('plugin' => null, 'controller' => 'my_users', 'action' => 'index', 'admin'=>true)); ?></li>
                <li><?php echo $this->Html->link(__('Download User List'), array('plugin' => null, 'controller' => 'my_users', 'action' => 'export', 'admin'=>true, "users.csv")); ?></li>
                <li><?php echo $this->Html->link(__('Download Song List'), array('plugin' => null, 'controller' => 'songs', 'action' => 'export', 'admin'=>true, "songs.csv")); ?></li>
                <li><?php echo $this->Html->link(__('Pending Songs').' <span class="badge">'.$settings['pendingcount'].'</span>', array('plugin' => null, 'controller' => 'songs', 'action' => 'pending', 'admin'=>true), array('escape'=>false)); ?></li>
                <li><?php echo $this->Html->link(__('Settings'), array('plugin' => null, 'controller' => 'pages', 'action' => 'settings', 'admin'=>true)); ?></li>
              </ul>
            </li>
            <?php endif; ?>
          </ul>
          <?php if ($this->Session->read('Auth.User.id')){ ?>
          	  <ul class="navbar-form pull-right">
<!--           	    <span class="navbar-text">Logged in as </span> -->
				<div class="btn-group nav">
				  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
				    <?php echo $this->Session->read('Auth.User.username') ?> <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li><?php echo $this->Html->link(__('My Profile'), array('plugin' => null, 'controller' => 'my_users', 'action' => 'view', 'admin'=>false, $this->Session->read('Auth.User.slug'))); ?></li>
				    <li><?php echo $this->Html->link(__('Edit Profile'), array('plugin' => null, 'controller' => 'my_users', 'action' => 'edit', 'admin'=>false)); ?></li>
				    <li><?php echo $this->Html->link(__('Change password'), array('plugin' => null, 'controller' => 'my_users', 'action' => 'change_password', 'admin'=>false)); ?></li>
				    <li class="divider"></li>
				    <li><a href="<?php echo Router::url('/logout'); ?>">Logout</a></li>
				  </ul>
				</div>
	          </ul>
	      <?php } else { ?>
	          <ul class="navbar-form pull-right">
		          <?php
		          	echo $this->Form->create('MyUser', array(
						'action' => 'login',
						'inputDefaults' => array(
							'class' => 'form-control',
							'label' => false,
							'div' => false
						),
						'style' => 'display:inline'
					));
		          	echo $this->Form->input('email', array('placeholder' => 'Email'));
		          	echo "&nbsp;";
		          	echo $this->Form->input('password', array('placeholder' => 'Password'));
		          	echo "&nbsp;";

			         echo $this->Form->end(array(
							'label' => __('Sign in'),
							'class' => 'btn btn-sm btn-default',
					        'div' => false
					));
		         ?>
		
		              <a href="<?php echo Router::url(array('plugin' => null, 'controller' => 'my_users', 'action' => 'add'), true); ?>">
		              	<button type="submit" class="btn btn-sm btn-primary">Register</button>
		              </a>
		          
	          </ul>
	      <?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>