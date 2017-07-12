<?php require_once(ROOT . '/views/layout/head.php'); ?>
<?php if (isset($_COOKIE['id_user'])) : ?>
	<?php echo 'eeee boy'; ?>
	<a href="/logout">Logout</a>
	<?php else : ?>
<form method="post" action="#">
	<input type="text" name="email" placeholder="email" value="<?php echo $email;?>" required><br>
	<input type="password" name="password" placeholder="password" required><br>
	<input type="submit" name="submit" value="Sign in"><br>
</form>
	<?php endif; ?>
<a href="/register">Register</a>
<?php require_once(ROOT.'/views/layout/footer.php');?>