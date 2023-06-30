<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newProductsModal">
    Afficher les nouveaux produits
</button>

<div class="modal fade" id="newProductsModal" tabindex="-1" role="dialog" aria-labelledby="newProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productsModalLabel">Produits non vérifiés</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                <h2>Liste des nouveaux produits</h2>
                    <div class="row">
                        <?php foreach ($newProducts as $product): ?>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
