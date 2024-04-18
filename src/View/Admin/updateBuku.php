<div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">

<?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>

    <form action="/book/update/<?= $model['book']['id'] ?>" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
                <h1 class="display-4 fw-bold 1h-1 mb-3 fs-1 text-center mb-5"><?= $model['title'] ?? 'Update Data Buku' ?></h1>
                <div class="form-floating mb-3">
                    <input name="title" id="title" placeholder="Belajar Pemrograman" type="text" class="form-control" value="<?= $model['book']['title'] ?? '' ?>">
                    <label for="title">Title</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="penulis" id="penulis" placeholder="Jhon Doe" type="text" class="form-control" value="<?= $model['book']['penulis'] ?? ''  ?>">
                    <label for="penulis">Penulis</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="penerbit" id="penerbit" placeholder="PT. a" type="text" class="form-control" value="<?= $model['book']['penerbit'] ?? '' ?>">
                    <label for="penerbit">Penerbit</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="tahunTerbit" id="tahunTerbit" placeholder="2002-12-01" type="text" class="form-control" value="<?= $model['book']['tahunTerbit'] ?? '' ?>">
                    <label for="tahunTerbit">Tahun Terbit</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="deskripsi" id="deskripsi" placeholder="masukkan deskripsi..." type="text-area" class="form-control" value="<?= $model['book']['deskripsi'] ?? '' ?>">
                    <label for="deskripsi">Deskripsi</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="idCategory" id="idCategory" class="form-select" required>
                        <option value="<?= $model['book']['idKategory'] ?? '' ?>"><?= $model['categoryid'] ?></option>
                        <?php foreach ($model['categories'] as $category) { ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php }?>
                    </select>
                    <label for="idCategory">Category</label>
                </div>
                <button class="w-100 btn btn-outline-warning" type="submit">Update</button>
            </form>
        </div>
</div>