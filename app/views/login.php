<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/login-head.php') ?>
</head>
    <body>
        <?php require_once('../app/views/partials/flash.php') ?>
        <main>
            <h1>Welcome</h1>
            <div class="notice">*admin/operator only*</div>
            <form action="login" method="post">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" class="login-btn">LOGIN</button>
            </form>
        </main>
    </body>
</html>
