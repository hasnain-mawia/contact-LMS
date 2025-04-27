<?php require_once 'common/header.php';?>


<div class="row justify-content-center wrapper">
<div class="col-md-6">
<?php if(!empty($_SESSION['errors'])){
    ?>
	<div class="alert alert-danger">
		<ul>
		<?php foreach($_SESSION['errors'] as $error){
			print '<li>' . $error . '</li>';
			} 
			?> 
        </ul>
		</div>
<?php
unset($_SESSION['errors']);  
} ?>


<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Sign In</h4>
</header>
<article class="card-body">
<form method="POST" action="<?php echo SITEURL .'actions/login_action.php'?>">
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control" placeholder="Email">
	</div> 
	<div class="form-group">
		<label>Password</label>
	    <input class="form-control" type="password" name="password" placeholder="password">
	</div>   
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success btn-block"> Login  </button>
    </div>       
</form>
</article>
<div class="border-top card-body text-center">Haven't an account? <a href="<?php echo SITEURL . 'signup.php';?>">Sign Up</a></div>
</div>
</div>

</div>

<?php require_once 'common/footer.php';?>