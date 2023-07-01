<button type="button" class="btn btn-primary m-2 col-3" data-toggle="modal" data-target="#usersModal">
    Afficher tout les utilisateurs
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
                    <h2>Liste de tout les utilisateurs</h2>
                    <div class="row">
                        <?php foreach ($users as $user): ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $user['firstname'] ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?= $user['lastname'] ?></h6>
                                        <p class="card-text">Pseudo: <?= $user['pseudo'] ?></p>
                                        <p class="card-text">Email: <?= $user['email'] ?></p>
                                        <?php if ($user['thumbnail']): ?>
                                            <img src="<?= $user['thumbnail'] ?>" alt="Thumbnail" class="card-img-top">
                                        <?php else: ?>
                                            <p>Aucune image</p>
                                        <?php endif; ?>
                                        <p class="card-text"><?= $user['is_verified'] ? 'Vérifié' : 'Non vérifié' ?></p>
                                        <div class="text-center">
                                            <a href="/validuser?userId=<?= $user['id'] ?>" class="btn btn-primary">Valider</a>
                                            <a href="/refuseuser?userId=<?= $user['id'] ?>" class="btn btn-primary">Exclure</a>
                                        </div>
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
