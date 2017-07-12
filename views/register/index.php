<?php require_once(ROOT . '/views/layout/head.php'); ?>
<?php if ($result) : ?>
    <p>eeee boy</p>
<?php else : ?>
    <form method="post" action="#">
        <input type="text" name="name" placeholder="name" value="<?php echo $name; ?>" required><br>
        <input type="text" name="surname" placeholder="surname" value="<?php echo $surname; ?>" required><br>
        <input type="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <input type="password" name="c_password" placeholder="confirm password" required><br>
        <input type="submit" name="submit" value="Sign up"><br>
    </form>
<?php endif; ?>
    <a href="/">Home</a>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>