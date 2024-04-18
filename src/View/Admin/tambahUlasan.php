<div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">
    
    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>

    <form action="/ulasan/add" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
    <h1 class="display-4 fw-bold 1h-1 mb-3 fs-1 text-center mb-5"><?= $model['title'] ?? 'Tambah Ulasan' ?></h1>
                <div class="form-floating mb-3">
                    <input name="username" id="username" placeholder="username" type="text" class="form-control" disabled value="<?= $model['username'] ?? '' ?>">
                    <label for="username">User</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="bookid" id="bookid" class="form-select" required>
                        <option value="<?= $_POST['bookid'] ?? '' ?>"><?= $_POST['title'] ?? '' ?></option>
                        <?php foreach ($model['books'] as $book) { ?>
                            <option value="<?= $book->id ?>"><?= $book->title ?></option>
                        <?php }?>
                    </select>
                    <label for="judul">Buku</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="ulasan" id="ulasan" placeholder="Ulasan anda..." type="text" class="form-control" value="<?= $_POST['ulasan'] ?? '' ?>">
                    <label for="ulasan">Ulasan</label>
                </div>
                <div class="form-floating mb-3">
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
        <button type="submit" class="w-100 button-inverted">Simpan</button>
    </form>
</div>