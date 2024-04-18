<div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="http://localhost:8080/" style="text-decoration: none;">Perpustakaan Digital</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="http://localhost:8080/" class="sidebar-link">
                            <i class="fa-solid fa-house pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <?php if($_SESSION['level'] != 'Peminjam') { ?>
                        <li class="sidebar-item">
                            <a href="http://localhost:8080/users" class="sidebar-link">
                                <i class="fa-solid fa-users pe-2"></i>
                                Users
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="http://localhost:8080/book" class="sidebar-link">
                                <i class="fa-solid fa-book-open pe-2"></i>
                                Buku
                            </a>
                        </li>
                    <?php } ?>
                    <li class="sidebar-item">
                        <a href="http://localhost:8080/peminjaman" class="sidebar-link">
                            <i class="fa-solid fa-book-open-reader pe-2"></i>
                            Peminjaman
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="http://localhost:8080/ulasan" class="sidebar-link">
                            <i class="fa-solid fa-comments pe-2"></i>
                            Ulasan
                        </a>
                    </li>
                    <?php if ($_SESSION['level'] != 'Peminjam') { ?>
                        <li class="sidebar-item">
                            <a href="http://localhost:8080/category" class="sidebar-link">
                                <i class="fa-solid fa-list pe-2"></i>
                                Category
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="http://localhost:8080/laporan" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                Laporan
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['level'] == 'Peminjam') { ?>
                        <li class="sidebar-item">
                            <a href="http://localhost:8080/koleksi" class="sidebar-link">
                                <i class="fa-solid fa-layer-group pe-2"></i>
                                Koleksi
                            </a>
                        </li>
                    <?php } ?>
                    <li class="sidebar-item">
                        <a href="http://localhost:8080/users/logout" class="sidebar-link">
                            <i class="fa-solid fa-right-from-bracket pe-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <i class="fa-solid fa-bars-staggered text-white"></i>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li><?= $_SESSION['username'] ?> | <?= $_SESSION['level'] ?></li> 
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                  <h1 class="display-4 fw-bold 1h-1 mb-3 fs-1 text-center mb-5"><?= $model['title'] ?? 'Koleksi Buku' ?></h1>
                  <?php if ($_SESSION['level'] == 'Peminjam') { ?>
                        <div class="px-4 d-flex flex-wrap gap-4">
                        <?php foreach ($model['koleksis'] as $koleksi) { ?>
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <p class="card-subtitle text-muted text-truncate"><?= $koleksi->penulis ?></p>
                                    <h5 class="card-title"><?= $koleksi->title ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $koleksi->penerbit ?></h6>
                                    <p class="card-text text-truncate"><?= $koleksi->deskripsi ?></p>
                                    <a href="http://localhost:8080/peminjaman/user/<?= $koleksi->userId; ?>/buku/<?= $koleksi->bookId; ?>" class="button-safety">Pinjam</a>
                                    <a class="button-rose" href="http://localhost:8080/koleksi/delete/<?= $koleksi->koleksiId ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    <footer class="py-4 bg-light mt-20">
                      <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Baso M. Alif Gifary SMK MUHAMMADIYAH 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </footer>
                </div>
            </main>
        </div>
    </div>
