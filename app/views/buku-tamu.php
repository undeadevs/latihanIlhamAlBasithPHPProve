<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/partials/nav.php') ?>
    <main class="buku-tamu">
        <h1>Buku Tamu</h1>
        <h3>Silahkan isi buku tamu untuk berkomentar</h3>
        <form class="generic-form buku-tamu" action="buku-tamu" method="post">
            <input type="text" name="name" id="name" placeholder="Nama" required>
            <input type="email" name="email" id="email" placeholder="Email (opsional)">
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Pesan..." required></textarea>
            <button class="submit-btn" type="submit">Kirim</button>
        </form>
    </main>
    <?php require_once('../app/views/partials/footer.php') ?>
</body>
</html>
