<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['title'] ?></h5>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <!-- Autres informations du produit -->
                    <form method="POST" action="/deleteProduct">
                        <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
