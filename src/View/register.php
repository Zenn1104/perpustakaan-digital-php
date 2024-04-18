<div class="wrapper">
<div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">

<?php if(isset($model['error'])) { ?>
    <div class="alert alert-danger">
        <?= $model['error'] ?>
    </div>
<?php } ?>

<div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
        <h2 class="display-4 fw-bold 1h-1 text-muted" style="font-size: 1.5rem; line-height: 1.75rem;">Perpustakaan Digital</h2>
        <h1 class="display-4 fw-bold 1h-1 mb-3" style="font-size: 6rem; line-height: 1;">Registrasi</h1>
        <p class="col-lg-7" style="font-size: 1.25rem; line-height: 1.75rem;"> by <a target="_blank" href="https://instagram.com/zennn.alf" class="text-blue-iris">Baso M. Alif Gifary</a></p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
        <form action="/users/register" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
            <div class="form-floating mb-3">
                <input name="username" id="username" placeholder="Jhon Doe" type="text" class="form-control" value="<?= $_POST['username'] ?? '' ?>">
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" id="password" placeholder="*******" type="password" class="form-control">
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input name="email" id="email" placeholder="jhondoe@gmail.com" type="text" class="form-control" value="<?= $_POST['email'] ?? '' ?>">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input name="alamat" id="alamat" placeholder="Jl. Mentari" type="text" class="form-control" value="<?= $_POST['alamat'] ?? '' ?>">
                <label for="alamat">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <select name="level" id="level" class="form-select" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="Peminjam">Peminjam</option>
                </select>
                <label for="level">level</label>
            </div>
            <button class="w-100 button-inverted" type="submit">Daftar</button>
            <p class="mt-5 text-center fs-6"> Sudah punya akun? <a href="/users/login" class="fw-bold text-blue-iris">Login</a></p>
        </form>
    </div>
</div>

</div>
</div>