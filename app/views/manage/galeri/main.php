<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/manage/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/manage/partials/sidebar.php') ?>
    <main class="galeri">
        <form id="delete-form" action="manage/galeri/_filename?_method=DELETE" method="post" hidden></form>
        <h1 class="title">Galeri</h1>
        <button class="add-image-btn" onclick="window.location.href='manage/galeri/add'">Add Image</button>
        <button class="delete-selected-btn">Delete Selected</button>
        <div class="images">
        <?php foreach(glob('images/gallery/*.*') as $filename): ?>
            <img class="image-item" src="<?=$filename?>" alt="<?=$filename?>">
        <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
