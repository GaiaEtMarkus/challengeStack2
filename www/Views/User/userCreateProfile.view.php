<!DOCTYPE html>
<div class="container">



    <h2>S'inscrire</h2>

    <?php print_r($errors??null);
extension_loaded('pdo_pgsql');
?>

    <?php $this->form("userCreateProfile", $form );?>


    <!-- <form action="/path/to/your/script" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>
        <div class="form-group">
            <label for="prenom">Téléphone</label>
            <input type="phone" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="prenom">E-mail</label>
            <input type="text" class="form-control" id="mail" name="mail" >
        </div>
        <div class="form-group">
            <label for="birth_date">Date de naissance</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date">
        </div>
        <div class="form-group">
            <label for="birth_date">Pays</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>
        <div class="form-group">
            <label for="thumbnail">Photo de profil</label>
            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
        </div>
        <div class="form-group">
            <label for="thumbnail">Mot de passe</label>
            <input type="password" class="form-control" id="pwd" name="pwd">
        </div>
        <div class="form-group">
            <label for="thumbnail">Confirmez votre mot de passe</label>
            <input type="password" class="form-control" id="confirmPwd" name="confirmPwd">
        </div>
        <a type="submit" href="/uservalidprofile"class="nav-link btn btn-primary">Créer le profil</a>
    </form>
</div> -->