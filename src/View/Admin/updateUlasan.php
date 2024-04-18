<div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">
    
    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>

    <form action="/ulasan/update/<?= $model['ulasan']['id'] ?? '' ?>" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
                <h1 class="display-4 fw-bold 1h-1 mb-3 fs-1 text-center mb-5"><?= $model['title'] ?? 'Update Ulasan Buku' ?></h1>
                <div class="form-floating mb-3">
                    <input name="username" id="username" placeholder="username" type="text" class="form-control" value="<?= $model['ulasan']['username'] ?? '' ?>"  disabled>
                    <label for="username">User</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="bookid" id="bookid" class="form-select" disabled>
                        <option value="<?= $model['ulasan']['bookid'] ?? '' ?>"><?= $model['ulasan']['title'] ?? '' ?></option>
                        <?php foreach ($model['books'] as $book) { ?>
                            <option value="<?= $book->id ?>"><?= $book->title ?></option>
                        <?php }?>
                    </select>
                    <label for="judul">Buku</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="text" id="text" placeholder="Ulasan anda..." type="text" class="form-control" value="<?= $model['ulasan']['text'] ?? '' ?>">
                    <label for="text">Ulasan</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="rating" id="rating" class="form-select">
                        <option value="<?= $model['ulasan']['rating'] ?>"><?php for ($i = 1; $i <= $model['ulasan']['rating']; $i++ ) {
                            echo '&#9733;';
                        } ?></option>
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
        <button type="submit" class="w-100 btn btn-outline-warning">Update</button>
    </form>
</div>