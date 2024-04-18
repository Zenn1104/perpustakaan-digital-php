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
                    <h1><?= $model['title'] ?? 'Daftar User' ?></h1>
                    <div class="mb-4">
                        <a href="http://localhost:8080/users/tambah" class="button-pale-iris">Tambah data</a>
                    </div>
                    <table class="table py-4">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($model['users'] as $user) { ?>
                        <tr>
                            <th scope="row"><?php echo $no++; ?></th>
                            <td><?php echo $user->username; ?></td>
                            <td class="truncation"><?php echo $user->password; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->alamat; ?></td>
                            <td><?php echo $user->level; ?></td>
                            <td>
                                <a href="http://localhost:8080/users/update/<?php echo $user->id ?>" class="button-amber" style="padding: 4px 5px;"><i class="fa-solid fa-pen"></i></a>
                                <a href="http://localhost:8080/users/delete/<?php echo $user->id ?>" class="button-rose" style="padding: 4px 5px;"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </main>
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
    </div>