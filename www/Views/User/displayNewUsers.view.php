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
              <a href="/validuser?userId=<?= $user['id'] ?>" class="btn btn-primary">Valider</a>
              <a href="#" class="btn btn-success">Valider</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
