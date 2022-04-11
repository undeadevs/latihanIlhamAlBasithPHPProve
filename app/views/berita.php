<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/partials/nav.php') ?>
    <main class="berita">
        <h1 class="title">Berita</h1>
        <div class="top">
            <h3 class="page-info">Page <?= $locals['pagination']['currPage'] ?> of <?= $locals['pagination']['totalPage'] ?></h4>
            <?php if($locals['pagination']['prevPage']!==''): ?>
                <button class="prev-btn fa fa-chevron-left" onclick="window.location.href='<?=$locals['pagination']['prevPage']?>'"></button>
            <?php else: ?>
                <button class="prev-btn disabled-btn fa fa-chevron-left"></button>
            <?php endif; ?>
            <?php if($locals['pagination']['nextPage']!==''): ?>
                <button class="next-btn fa fa-chevron-right" onclick="window.location.href='<?=$locals['pagination']['nextPage']?>'"></button>
            <?php else: ?>
                <button class="next-btn disabled-btn fa fa-chevron-right"></button>
            <?php endif; ?>
        </div>
        <div class="berita-list">
            <?php if(is_array($locals['rows'])) foreach($locals['rows'] as $row): ?>
                <div class="berita-item">
                    <img src="<?=file_exists('images/news/'.$row['id'].'.png')?'images/news/'.$row['id'].'.png':'images/news/'.$row['id'].'.jpg'?>" alt="" class="berita-img">
                    <div class="berita-info">
                        <p class="berita-date"><?=$row['date']?></p>
                        <a href="berita/<?=$row['id']?>" class="berita-title"><?=$row['title']?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php require_once('../app/views/partials/footer.php') ?>
</body>
</html>
