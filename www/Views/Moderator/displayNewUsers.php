<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newsUsersModal">
    Afficher les nouveaux utilisateurs
</button>

<div class="modal fade" id="newsUsersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
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
                    <h2>Liste des nouveaux utilisateurs</h2>
                    <div class="row">
                        <?php foreach ($newUsers as $user): ?>
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

                                        <form method="POST" action="/validuser">
                                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                            <button type="submit" class="btn btn-primary">Valider</button>
                                        </form>

                                        <form method="POST" action="/refuseuser">
                                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                            <button type="submit" class="btn btn-dangers">Exclure</button>
                                        </form>

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
