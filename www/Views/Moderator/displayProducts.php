<button type="button" class="btn btn-primary col-3 m-2" data-toggle="modal" data-target="#usersModal">
    Afficher tout les produits
</button>

<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersModalLabel">Nouveaux utilisateurs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
    <h2>Liste des produits vérifiés</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <?php if ($product['id_seller'] !== $_SESSION['userData']['id']): ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['title'] ?></h5>
                            <!-- <p class="card-text"><?= $product['description'] ?></p> -->
                            <p class="card-text"><?= $product['trokos'] ?></p>
                            <form method="POST" action="/createTransaction">
                                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-primary">Valider</button>
                                <a href="/displayDetailsProduct?productId=<?= $product['id'] ?>" class="btn btn-primary">Détails</a>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['title'] ?></h5>
                            <!-- <p class="card-text"><?= $product['description'] ?></p> -->
                            <p class="card-text"><?= $product['trokos'] ?></p>
                            <a href="/displayDetailsProduct?productId=<?= $product['id'] ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
