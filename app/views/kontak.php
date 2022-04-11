<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/partials/nav.php') ?>
    <main class="kontak">
        <h1>Kontak Kami</h1>
        <h3>Email: <?=COMPANY_EMAIL?></h3>
        <h3>No Telp: <?=COMPANY_PHONE?></h3>
        <form class="generic-form kontak" action="kontak" method="post">
            <input type="text" name="name" id="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" id="email" placeholder="Email">
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Pesan..." required></textarea>
            <button class="submit-btn" type="submit">Kirim</button>
        </form>
    </main>
    <?php require_once('../app/views/partials/footer.php') ?>
</body>
</html>
