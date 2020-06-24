<!DOCTYPE html>
<html>
<head>
	<title>Task</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">

	<!-- Latest compiled and minified CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="http://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
</head>
<body class="col-md-push-1 col-md-10">
	 <nav class="navbar navbar-inverse container">
      <div class="col-xs-12">
        <ul class="headd">
            <li class="col-xs-6 col-md-8">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle"
            data-toggle="collapse"
            data-target="#mynavbar"
            style="float:left;"
          >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>">HOME</a></li>
            <li><a href="<?php echo base_url(); ?>articles">ARTICLES</a></li>
            <?php if(!$this->session->userdata('logged_in')) : ?>
              <li><a href="<?php echo base_url(); ?>admins/login">LOGIN</a></li>
              <li><a href="<?php echo base_url(); ?>admins/register">REGISTER</a></li>
            <?php endif; ?>
            <?php if($this->session->userdata('logged_in')) : ?>
              <li><a href="<?php echo base_url(); ?>admins/panel">MY PANEL</a></li>
              <li><a href="<?php echo base_url(); ?>articles/create">CREATE ARTICLE</a></li>
              <li><a href="<?php echo base_url(); ?>admins/logout">LOGOUT</a></li>
            <?php endif; ?>
            </ul>
        </div>
            <li>
                <form class="navbar-form navbar-right" action="">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Search Articles"
                    />
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                      </button>
                    
                  </div>
                </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <?php if($this->session->flashdata('user_registred')): ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>' ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('post_created')): ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>' ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('post_updated')): ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>' ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_loggedin')): ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>' ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_loggedout')): ?>
          <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>' ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('login_failed')): ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>' ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('post_deleted')): ?>
          <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('post_deleted').'</p>' ?>
      <?php endif; ?>

