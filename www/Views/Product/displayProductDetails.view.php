<div class="container">
    <h2>Detail du produit</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="<?= $product['thumbnail'] ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h4 class="card-title"><?= $product['title'] ?></h4>
                    <h5 class="card-title">Echangeur : <?= $userData[0]['pseudo'] ?></h5>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p class="card-text"><?= $product['trokos'] ?></p>

                    <form method="POST" action="/opentransaction">
                        <input type="hidden" name="productId" value="<?= $product['id'] ?>">                   
                        <a href="/displayUserStats?userId=<?= $userData[0]['id'] ?>" class="btn btn-primary">Profil de l'utilisateur</a>
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#commentsModal-<?= $product['id']?>">
                            Afficher les commentaires
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="commentsModal-<?= $product['id']?>" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentsModalLabel">Commentaires</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form method="POST" action="/createcomment">
                <div class="form-group">
                    <label for="commentContent">Contenu du commentaire :</label>
                    <textarea class="form-control" id="commentContent" name="commentContent" rows="3" required></textarea>
                </div>
                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                <input type="hidden" name="userId" value="<?= $_SESSION['userData']['id'] ?>">
                <button type="submit" class="btn btn-primary mb-2">Ajouter un commentaire</button>
            </form>

            <h5>Commentaires existants :</h5>
                <div class="existing-comments">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <p class="comment-content"><?= $comment['content'] ?></p>
                            <p class="comment-date">Date : <?= $comment['date'] ?></p>
                            <p class="comment-author">Auteur : <?= $comment['pseudo']?></p>

                            <?php if ($comment['id_user'] == $_SESSION['userData']['id'] AND $_SESSION['userData']['id_role'] == 3): ?>
                                <form  method="POST" action="/signalComment">
                                    <input type="hidden" name="idComment" value="<?= $comment['id'] ?>">
                                    <button class="btn btn-danger mt-2" type="submit">Signaler commentaire</button>
                                </form>
                            <?php endif; ?>


                            <?php if ($comment['id_user'] == $_SESSION['userData']['id'] || $_SESSION['userData']['id_role'] == 2): ?>
                                <form method="POST" action="/deleteComment">
                                    <input type="hidden" name="idComment" value="<?= $comment['id'] ?>">
                                    <button class="btn btn-danger" type="submit">Supprimer</button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <hr class="bg-dark">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

