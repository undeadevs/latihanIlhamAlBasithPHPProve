<nav>
    <div class="logo">
        <div class="company-name">BASITHSJ</div>
    </div>
    <button class="burger-menu fa fa-bars"></button>
    <ul class="nav-links">
        <li><a href="beranda">Beranda</a></li>
        <li><a href="profile">Profile</a></li>
        <li><a href="berita">Berita</a></li>
        <li><a href="galeri">Galeri</a></li>
        <li><a href="buku-tamu">Buku Tamu</a></li>
        <li><a href="kontak">Kontak</a></li>
        <li class="nav-cta">
            <?php if(isset($GLOBALS['user'])): ?>
                <a href="manage">Manage</a>
            <?php else: ?>
                <a href="login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>