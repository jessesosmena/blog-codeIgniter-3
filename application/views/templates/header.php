<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <title>Blog App in CodeIgniter 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('bootstrap/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/custom.css'); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="<?php echo base_url('jquery/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo base_url('assets/jquery.validate.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/additional-methods.min.js'); ?>"></script>

    <style type="text/css">
      #email-error {
         color: #FF6347;
      }
      #name-error {
         color: #FF6347;
      }
      #body-error {
         color: #FF6347;
      }
    </style>
   
    <script>
    $(document).ready(function () {
       
       $('#myform').validate({ // initialize the plugin
        rules: {
           name: "required",
           body: "required",
           email: "required email",
        },

        messages: {
           name: "Enter your name",
           body: "Enter your message",
           email: {
                required: "Enter your Email",
                email: "Please enter a valid email address.",

            }
        }

     });
         
   });
   </script>

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url('home'); ?>">Blog in CI3</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url('home'); ?>">Home <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Posts <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('posts'); ?>">Post</a></li>
            <li><a href="<?php echo base_url('categories'); ?>">Groups</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!$this->session->userdata('logged_in')) : ?>
        <li><a href="<?php echo base_url('users/login'); ?>">Login</a></li>
        <li><a href="<?php echo base_url('users/register'); ?>">Sign Up</a></li>
        <?php endif; ?>

        <?php if($this->session->userdata('logged_in')) : ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($this->session->userdata('username')) ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('posts/create'); ?>">Create Post</a></li>
            <li><a href="<?php echo base_url('categories/create'); ?>">Create Group</a></li>
            <li><a href="<?php echo base_url('users/profile'); ?>">Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

<?php if($this->session->flashdata('user_registered')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('post_created')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('post_updated')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('category_created')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('post_deleted')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('post_deleted').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('user_loggedin')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin'),  ucfirst($this->session->userdata('username')).'!</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('login_failed')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('user_loggedout')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('temporary_registered')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('temporary_registered').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('registration_failed')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('registration_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('forgot_pass_success')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('forgot_pass_success').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('forgot_pass_failed')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('forgot_pass_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('reset_pass_failed')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('reset_pass_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('reset_pass_success')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('reset_pass_success').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('reset_pass_update_failed')) : ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('reset_pass_update_failed').'</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('reset_pass_update_success')) : ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('reset_pass_update_success').'</p>'; ?>
<?php endif; ?>



















