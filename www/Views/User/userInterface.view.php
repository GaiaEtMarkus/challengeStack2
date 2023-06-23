<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['title'] ?></h5>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p class="card-text"><?= $product['trokos'] ?></p>
                    <form method="POST" action="/deleteProduct">
                        <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <?php echo($product['id']);?>
                    <form method="POST" action="/modifyproduct">
                    <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
