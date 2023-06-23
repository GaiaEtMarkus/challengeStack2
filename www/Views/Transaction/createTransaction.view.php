<div class="container">
    <h2>Créer une nouvelle transaction</h2>
    <form method="POST" action="/saveTransaction">
        <input type="hidden" name="productReceiverId" value="<?= $productData['id'] ?>">
        <input type="hidden" name="receiverId" value="<?= $productData['id_seller'] ?>">
        <input type="hidden" name="receiverTrokos" value="<?= $productData['trokos'] ?>">

        <div class="form-group">
            <label for="exchangeProductId">Produit à proposer en échange :</label>
            <select name="exchangeProductId" class="form-control">
                <option value="">Sélectionner un produit</option>
                <?php foreach ($exchangeProducts as $exchangeProduct): ?>
                    <option value="<?= $exchangeProduct['id'] ?>">
                        <?= $exchangeProduct['title'] ?> - <?= $exchangeProduct['trokos'] ?> trokos
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
