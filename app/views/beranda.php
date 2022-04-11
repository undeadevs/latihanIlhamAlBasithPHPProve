<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../app/views/partials/head.php') ?>
</head>
<body>
    <?php require_once('../app/views/partials/flash.php') ?>
    <?php require_once('../app/views/partials/nav.php') ?>
    <main class="beranda">
        <section class="hero">
            <h1>Put Your Trust On Us</h1>
            <p>Menyediakan jasa ekspedisi pengiriman barang yang mudah via laut dan darat</p>
            <button class="cta-btn">LEARN MORE</button>
        </section>
        <section class="prosedur">
            <h2>Prosedur Pelayanan</h2>
            <ul class="prosedur-list">
                <li class="prosedur-card">
                    <div class="card-icon fa fa-send"></div>
                    <div class="card-title">Pengiriman Barang</div>
                </li>
                <li class="prosedur-card">
                    <div class="card-icon fa fa-check"></div>
                    <div class="card-title">Pemeriksaan Container Empty</div>
                </li>
                <li class="prosedur-card">
                    <div class="card-icon fa fa-cubes"></div>
                    <div class="card-title">Penentuan Berat Max Container</div>
                </li>
                <li class="prosedur-card">
                    <div class="card-icon fa fa-list"></div>
                    <div class="card-title">Aturan Barang Tertentu</div>
                </li>
            </ul>
        </section>
        <section class="berita">
            <h2>Berita Terkini</h2>
            <div class="berita-list owl-carousel owl-theme">
                <?php if(is_array($locals['rows'])) foreach($locals['rows'] as $row): ?>
                    <div class="berita-item">
                        <img class="berita-img" src="<?=file_exists('images/news/'.$row['id'].'.png')?'images/news/'.$row['id'].'.png':'images/news/'.$row['id'].'.jpg'?>" alt="BERITA">
                        <a href="berita/<?=$row['id']?>" class="berita-link"><?=$row['title']?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php require_once('../app/views/partials/footer.php') ?>
</body>
</html>
