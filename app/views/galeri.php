<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/partials/nav.php') ?>
    <main class="galeri">
        <h1 class="title">Galeri</h1>
        <div class="images">
        <?php foreach(glob('images/gallery/*.*') as $filename): ?>
            <img class="image-item" src="<?=$filename?>" alt="<?=$filename?>">
        <?php endforeach; ?>
        </div>
    </main>
    <?php require_once('../app/views/partials/footer.php') ?>
</body>
</html>
