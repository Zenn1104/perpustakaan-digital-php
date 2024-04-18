<div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="http://localhost:8080/" style="text-decoration:none">Perpustakaan Digital</a>
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
                <div class="container-fluid d-flex justify-content-center align-items-center py-4">
                  <div class="card" style="width: 50%;">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted"><?= $model['book']['penulis'] ?></h6>
                            <h4 class="card-title fw-bold"><?= $model['book']['title'] ?></h4>
                            <h6 class="card-subtitle mb-2">Penerbit : <?= $model['book']['penerbit'] ?></h6>
                            <h6 class="card-subtitle mb-2">Tahun Terbit : <?= $model['book']['tahunTerbit'] ?></h6>
                            <p class="card-subtitle fw-bold mb-2">Deskripsi Buku</p>
                            <p class="card-subtitle"><?= $model['book']['deskripsi'] ?></p>
                            <div class="container mt-5">
                            <!-- Kolom ulasan -->
                                <div class="card">
                                    <div class="card-header text-center fw-bold">
                                        Ulasan
                                    </div>
                                    <div class="card-body chats">
                                        <!-- ulasan -->
                                        <?php foreach ($model['ulasans'] as $ulasan) { ?>
                                            <div class="mb-2">
                                                <strong><?= $ulasan->username ?></strong>
                                                <p>
                                                    <?php for ($i = 1; $i <= $ulasan->rating; $i++ ) {
                                                        echo '&#9733;';
                                                    } ?>
                                                </p>
                                                <p><?= $ulasan->text ?></p>
                                                <hr>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <form action="http://localhost:8080/ulasan/buku/<?= $model['book']['id']?>" method="POST" class="d-flex flex-column">
                                        <div class="form-floating">
                                            <select name="rating" id="rating" class="form-select">
                                                <option value="1">&#9733;</option>
                                                <option value="2">&#9733;&#9733;</option>
                                                <option value="3">&#9733;&#9733;&#9733;</option>
                                                <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                                <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                <option value="6">&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                <option value="7">&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                <option value="8">&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                <option value="9">&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                                <option value="10">&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                            </select>
                                            <label for="rating">Rating</label>
                                        </div>
                                        <div class="d-flex">
                                            <div class="input">
                                                <input type="text" name="text" id="text" class="chat-input" placeholder="ketik sesuatu" value="<?= $_POST['text'] ?? '' ?>">
                                            </div>
                                            <button class="button-chat" type="submit">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <a href="http://localhost:8080/koleksi/add/buku/<?= $model['book']['id']; ?>" class="button-amber mb-4"><i class="fa-solid fa-star"></i></a>
                            <a href="http://localhost:8080/peminjaman/user/<?= $model['userid']; ?>/buku/<?= $model['book']['id']; ?>" class="button-safety mb-4">Pinjam</a>
                        </div>
                  </div>
                </div>
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
            </main>
        </div>
    </div>
