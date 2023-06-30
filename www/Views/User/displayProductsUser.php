<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productsModal">
    Afficher vos produits
</button>

<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productsModalLabel">Produits disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($productsUser as $product): ?>
                        <div class="col-md-6">
                            <div class="card">
                                <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['title'] ?></h5>
                                    <p class="card-text">Trokos : <?= $product['trokos'] ?></p>
                                    <form method="POST" action="/modifyProduct">
                                        <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </form>
                                    <a class="nav-link text-danger" href="/deleteProduct?productId=<?php echo $product['id']; ?>">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>