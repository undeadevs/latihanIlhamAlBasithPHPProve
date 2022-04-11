<div class="toggle-sidebar">=</div>
<nav class="sidebar">
    <div class="company-name">BASITHSJ</div>
    <ul class="nav-links">
        <li>
            <a href="manage/dashboard">
                <div class="icon fa fa-tv"></div>
                <span class="label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="manage/berita">
                <div class="icon fa fa-newspaper-o"></div>
                <span class="label">Berita</span>
            </a>
        </li>
        <li>
            <a href="manage/galeri">
                <div class="icon ion-md-grid"></div>
                <span class="label">Galeri</span>
            </a>
        </li>
        <li>
            <a href="manage/buku-tamu">
                <div class="icon fa fa-address-book"></div>
                <span class="label">Buku Tamu</span>
            </a>
        </li>
        <?php if($GLOBALS['user']['role']==='admin'): ?>
        <li>
            <a href="manage/user">
                <div class="icon fa fa-user-circle"></div>
                <span class="label">User</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <button class="logout-btn">
        <div class="icon fa fa-sign-out"></div>
        <span class="label">LOGOUT</span>
    </button>
    <form id="logout-form" action="logout?_method=DELETE" method="post" hidden></form>
</nav>