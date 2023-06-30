<div class="container">
    <div class="card" style="width: 300px;">
        <img class="card-img-top" src="<?php echo $userData[0]['thumbnail']; ?>" alt="Portrait de l'utilisateur">
        <div class="card-body">
            <h5 class="card-title">Pseudo : <?php echo $userData[0]['pseudo']; ?></h5>
            <h5 class="card-title"><?php echo($userData[0]['firstname'] ) ; ?> <?php echo($userData[0]['lastname'] ) ; ?></h5>
            <p class="card-text">Produits mis en troc : <?php echo($countProducts) ; ?></p>
            <p class="card-text">Transactions effectuées : <?php echo($countTransactions) ; ?></p>
            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#commentsModal-<?= $userData[0]['id']?>">
                Afficher les commentaires
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="commentsModal-<?= $userData[0]['id']?>" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="userId" value="<?= $userData[0]['id'] ?>">
                <button type="submit" class="btn btn-primary">Ajouter un commentaire</button>
            </form>

            <h5>Commentaires existants :</h5>
                <div class="existing-comments">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <p class="comment-content"><?= $comment['content'] ?></p>
                            <p class="comment-date">Date : <?= $comment['date'] ?></p>
                            <p class="comment-author">Auteur : <?= $comment['pseudo']?></p>

                            <form method="POST" action="/signalComment">
                                <input type="hidden" name="idComment" value="<?= $comment['id'] ?>">
                                <button class="btn btn-danger" type="submit">Signaler commentaire</button>
                            </form>

                            <?php if ($comment['id_user'] == $_SESSION['userData']['id'] AND $_SESSION['userData']['id_role'] == 2): ?>
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