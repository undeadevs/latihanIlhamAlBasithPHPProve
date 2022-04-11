<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/manage/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/manage/partials/sidebar.php') ?>
    <main class="dashboard">
        <h1 class="welcome">Selamat Datang</h1>
        <div class="username"><?= $GLOBALS['user']['username'] ?></div>
    </main>
</body>
</html>
