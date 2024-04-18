<div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">
    
    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>

    <form action="/category/add" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
    <h1 class="display-4 fw-bold 1h-1 mb-3 fs-1 text-center mb-5"><?= $model['title'] ?? 'Tambah Ulasan' ?></h1>
                <div class="form-floating mb-3">
                    <input name="name" id="name" placeholder="Makalah" type="text" class="form-control" value="<?= $_POST['name'] ?? '' ?>">
                    <label for="name">Nama Category</label>
                </div>
        <button type="submit" class="button-inverted">Simpan</button>
    </form>
</div>