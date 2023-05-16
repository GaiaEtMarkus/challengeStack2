<!DOCTYPE html>
<div class="container">
    <h2>Création de profil</h2>
    <form action="/path/to/your/script" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom">
        </div>
        <div class="form-group">
            <label for="birth_date">Date de naissance</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date">
        </div>
        <div class="form-group">
            <label for="thumbnail">Photo de profil</label>
            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
        </div>
        <button type="submit" class="btn btn-primary">Créer le profil</button>
    </form>
</div>
