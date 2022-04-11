<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/manage/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/manage/partials/sidebar.php') ?>
    <main class="berita has-form">
        <h4><?=$locals['title']?></h4>
        <form action="manage/galeri/add" method="post" enctype="multipart/form-data">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" required/>
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
