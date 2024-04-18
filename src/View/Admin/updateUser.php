<div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">

<?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>

    <form action="/users/update/<?= $model['user']['id'] ?>" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                <h1 class="display-4 fw-bold 1h-1 mb-3 fs-1 text-center mb-5"><?= $model['title'] ?? 'Update User' ?></h1>
                <div class="form-floating mb-3">
                    <input name="username" id="username" placeholder="Jhon Doe" type="text" class="form-control" value="<?= $model['user']['username'] ?? '' ?>">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" id="password" placeholder="*******" type="password" class="form-control">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="email" id="email" placeholder="jhondoe@gmail.com" type="text" class="form-control" value="<?= $model['user']['email'] ?? '' ?>">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="alamat" id="alamat" placeholder="Jl. Mentari" type="text" class="form-control" value="<?= $model['user']['alamat'] ?? '' ?>">
                    <label for="alamat">Alamat</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="level" id="level" class="form-select" required>
                        <option value="<?= $model['user']['level'] ?? '' ?>"><?= $model['user']['level']?></option>
                        <option value="Admin">Admin</option>
                        <option value="Peminjam">Peminjam</option>
                        <option value="Petugas">Petugas</option>
                    </select>
                    <label for="level">Level</label>
                </div>
                <button class="w-100 btn btn-outline-warning" type="submit">Update</button>
            </form>
        </div>
    </div>