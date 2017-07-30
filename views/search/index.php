<?php require_once(ROOT . '/views/layout/head.php'); ?>

    <div class="container-fluid">

        <?php require_once (ROOT.'/views/layout/menu.php'); ?> <!-- header -->

        <?php
        $pdo = DataBase::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row) {
            echo "<img src='$row[avatar]' style='width: 100px; height: 120px'>";
            echo "<p><a href='/profile/$row[id]'>$row[login]</a></p>";
        }
        ?>
    </div>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>