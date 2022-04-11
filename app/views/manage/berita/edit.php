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
        <form action="manage/berita/add" method="post" enctype="multipart/form-data">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?=$locals['data']['date']?>" required>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?=$locals['data']['title']?>" required>
            <label for="image">Media</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" required>
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" required><?=$locals['data']['content']?></textarea>
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
