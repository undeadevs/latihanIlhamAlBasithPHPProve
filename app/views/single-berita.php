<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/partials/nav.php') ?>
    <main class="single-berita">
        <h2 class="title"><?=$locals['data']['title']?></h2>
        <img src="<?=file_exists('images/news/'.$locals['data']['id'].'.png')?'images/news/'.$locals['data']['id'].'.png':'images/news/'.$locals['data']['id'].'.jpg'?>" alt="" class="image">
        <p class="content">
            <?=$locals['data']['content']?>
        </p>
    </main>
    <?php require_once('../app/views/partials/footer.php') ?>
</body>
</html>