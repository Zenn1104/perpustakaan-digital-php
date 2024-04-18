<div class="container col-xl-10 col-xxl-8 px-4 py-5">

    <?php if(isset($model['error'])) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
    <?php } ?>

    <div class="row align-items-center justify-content-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
        <h2 class="display-4 fw-bold 1h-1 text-muted" style="font-size: 1.5rem; line-height: 1.75rem;">Perpustakaan Digital</h2>
        <h1 class="display-4 fw-bold 1h-1 mb-3" style="font-size: 6rem; line-height: 1;">Login</h1>
        <p class="col-lg-7" style="font-size: 1.25rem; line-height: 1.75rem;"> by <a target="_blank" href="https://instagram.com/zennn.alf" class="text-blue-iris">Baso M. Alif Gifary</a></p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form action="/users/login" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
                <div class="form-floating mb-3">
                    <input type="text" name="username" id="username" placeholder="Jhon Doe" class="form-control" value="<?= $_POST['username'] ?? '' ?>">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" placeholder="******" class="form-control">
                    <label for="password">Password</label>
                </div>
                <button class="w-100 button-inverted" type="submit">Login</button>
                <p class="mt-5 text-center fs-6">Tidak memiliki akun? <a href="/users/register" class="fw-bold text-blue-iris">Registrasi</a></p>
            </form>
        </div>
    </div>
</div>