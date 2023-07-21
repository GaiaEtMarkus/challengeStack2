<button type="button" class="btn btn-primary col-3 m-3" data-toggle="modal" data-target="#transactionsModal">
    Afficher mes transactions
</button>

<div class="modal fade" id="transactionsModal" tabindex="-1" role="dialog" aria-labelledby="transactionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionsModalLabel">Vos demandes d'échanges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php foreach ($userProducts as $productId => $userProduct): ?>
                            <div class="card-group m-2">
                                <div class="card col-10">
                                    <img src="<?= $userProduct['thumbnail'] ?>" class="card-img-top" alt="<?= $userProduct['title'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $userProduct['title'] ?></h5>
                                        <p class="card-text">Trokos : <?= $userProduct['trokos'] ?></p>
                                    </div>
                                </div>
                                <div class="card col-10">
                                    <img src="<?= $otherProducts[$productId]['thumbnail'] ?>" class="card-img-top" alt="<?= $otherProducts[$productId]['title'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $otherProducts[$productId]['title'] ?></h5>
                                        <p class="card-text">Trokos : <?= $otherProducts[$productId]['trokos'] ?></p>
                                    </div>
                                    <?php if (isset($userProduct['isReceiver']) && $userProduct['isReceiver'] == true): ?>
                                        <div class="card-footer">
                                            <form method="post" action="/validatetransaction">
                                                <input type="hidden" name="transactionId" value="<?= $userProduct['transactionId'] ?>">
                                                <button type="submit" class="btn btn-primary">Valider la transaction</button>
                                                </form>                                        
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
    </div>
</div>