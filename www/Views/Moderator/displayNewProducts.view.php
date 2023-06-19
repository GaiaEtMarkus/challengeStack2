<div class="container">
    <h2>Liste des produits non vérifiés</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <form method="POST" action="/validProduct">
                            <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                            <div class="form-group">
                                <label for="trokos">Valeur de Trokos :</label>
                                <input type="number" class="form-control" id="trokos" name="trokos" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
