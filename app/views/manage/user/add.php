<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/manage/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/manage/partials/sidebar.php') ?>
    <main class="user has-form">
        <h4><?=$locals['title']?></h4>
        <form action="manage/user/add" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="" hidden disabled selected>--None--</option>
                <option value="admin">admin</option>
                <option value="operator">operator</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
