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
                <div class="row">
                    <div class="col-12 col-md-6 d-flex py-4">
                        <div class="card flex-fill border-0 illustration">
                            <div class="card-body p-0 d-flex flex-fill">
                                <div class="row g-0 w-100">
                                    <div class="col-6">
                                        <div class="p-3 m-1">
                                            <h1 class="mt-4 h-1">Selamat Datang <?php echo $model['user']['username']; ?> </h1>
                                            <ol class="breadcrumb mb-0">
                                                <li class="breadcrumb-item active"><?php echo $model['user']['level']; ?> | Login at <?php echo date('d F Y');?></li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-end text-end">
                                        <img src="../assets/img/image-hero.png" class="img-fluid illustration-img" alt="hero-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex py-4">
                        <div class="card flex-fill border-0">
                            <div class="card-body py-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex">
                                        <iframe width="50%" height="250" src="https://www.openstreetmap.org/export/embed.html?bbox=120.02829551696779%2C-4.136637952719475%2C120.03032863140108%2C-4.135035493429926&amp;layer=mapnik&amp;marker=-4.135835385867697%2C120.02931207418442" style="border: 1px solid black"></iframe><br/>
                                        <div class="mx-auto">
                                            <div class="text-center">
                                                <p class="fw-bold fs-5 mb-0">Perpustakaan Digital</p>
                                                <p class="fw-bold fs-5 mb-0">SMK MUHAMMADIYAH</p>
                                                <p class="fw-light fs-6 mb-0">Jl.Muhammadiyah No.14 Sengkang</p>
                                                <span class="badge bg-light text-dark">Buka Senin-Jumat 07:30 - 16:30</span>
                                                <hr>
                                            </div>
                                            <div class="py-2">
                                                <span class="fw-light" style="font-size: 12px;">
                                                <i class="fa-solid fa-envelope pe-2"></i> smksmuhammadiyahsengkang@gmail.com
                                                </span>
                                            </div>
                                            <div class="py-2">
                                                <span class="fw-light" style="font-size: 12px;">
                                                <i class="fa-brands fa-square-instagram pe-2"></i> smksmuhammadiyahsengkang
                                                </span>
                                            </div>
                                            <div class="py-2">
                                                <span class="fw-light" style="font-size: 12px;">
                                                <i class="fa-brands fa-square-facebook pe-2"></i> smksmuhammadiyahsengkang
                                                </span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php if ($model['user']['level'] != 'Peminjam') { ?>
                        <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-blue-iris text-white mb-4">
                                <div class="card-body">
                                <div class="sb-nav-link-icon p-2 h1 text-center">
                                    <i class="fas fa-users"></i>
                                </div>    
                                <div class="sb-nav-link-icon h3 text-center">
                                    Users
                                </div>    
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="http://localhost:8080/users">
                                        View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-safety-orange text-white mb-4">
                                <div class="card-body">
                                <div class="sb-nav-link-icon p-2 h1 text-center">
                                    <i class="fa-solid fa-list"></i>
                                </div>    
                                <div class="sb-nav-link-icon h3 text-center">
                                    Kategori
                                </div>    
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="http://localhost:8080/category">
                                        View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-amber text-white mb-4">
                                <div class="card-body">
                                <div class="sb-nav-link-icon p-2 h1 text-center">
                                    <i class="fas fa-book-open"></i>
                                </div>    
                                <div class="sb-nav-link-icon h3 text-center">
                                    Buku
                                </div>    
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="http://localhost:8080/book">
                                        View Details <?= count($model['books']) ?></a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-pale-iris text-white mb-4">
                                <div class="card-body">
                                <div class="sb-nav-link-icon p-2 h1 text-center">
                                    <i class="fa-solid fa-book-open-reader"></i>
                                </div>    
                                <div class="sb-nav-link-icon h3 text-center">
                                    Peminjam
                                </div>    
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="http://localhost:8080/peminjaman">
                                        View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xl-6">
                        </div>
                    </div>
                    <?php if ($model['user']['level'] == 'Peminjam') { ?>
                        <div class="px-4 d-flex flex-wrap gap-4">
                        <?php foreach ($model['books'] as $book) { ?>
                            <div class="card" style="width: 18rem; max-height: 15rem;">
                                <div class="card-body">
                                    <p class="card-subtitle text-muted text-truncate"><?= $book->penulis ?></p>
                                    <h5 class="card-title"><?= $book->title ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $book->penerbit ?></h6>
                                    <p class="card-text text-truncate"><?= $book->deskripsi ?></p>
                                    <a href="http://localhost:8080/peminjaman/user/<?= $model['user']['id']; ?>/buku/<?= $book->id; ?>" class="button-safety">Pinjam</a>
                                    <a class="button-inverted" href="http://localhost:8080/book/<?= $book->id ?>">
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($model['user']['level'] != 'Peminjam') { ?>
                    <div class="container-fluid">
                    <table class="table py-4">
                    <thead class="table-primary">
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Judul</th>
                              <th scope="col">Penulis</th>
                              <th scope="col">Penerbit</th>
                              <th scope="col">Tahun Terbit</th>
                              <th scope="col">Deskripsi</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php if(isset($model['error'])) { ?>
                            <td colspan="7"><?php echo $model['error'] ?></td>
                        <?php } else { ?>
                            <?php $no = 1; ?>
                            <?php foreach ($model['books'] as $book) { ?>
                            <tr>
                                <th scope="row"><?php echo $no++; ?></th>
                                <td class="text-truncate" style="max-width: 200px;"><?php echo $book->title; ?></td>
                                <td class="text-truncate" style="max-width: 150px"><?php echo $book->penulis; ?></td>
                                <td><?php echo $book->penerbit; ?></td>
                                <td><?php echo $book->tahunTerbit; ?></td>
                                <td class="text-truncate" style="max-width: 250px;" ><?php echo $book->deskripsi; ?></td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
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