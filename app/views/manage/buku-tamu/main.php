<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/manage/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/manage/partials/sidebar.php') ?>
    <main class="buku-tamu has-table">
        <div class="top">
            <h4 class="table-title"><?=$locals['title']?></h4>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
                <?php if(is_array($locals['rows'])) foreach($locals['rows'] as $row): ?>
                    <tr>
                        <td><?=$row['name']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$row['message']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="bottom">
            <h4 class="page-info">Page <?= $locals['pagination']['currPage'] ?> of <?= $locals['pagination']['totalPage'] ?></h4>
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
    </main>
</body>
</html>
