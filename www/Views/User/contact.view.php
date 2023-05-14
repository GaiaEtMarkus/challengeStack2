<form action="submit_form.php" method="POST">
    <div class="form-group">
        <label for="inputNom">Nom :</label>
        <input type="text" class="form-control" id="inputNom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="inputPrenom">Prénom :</label>
        <input type="text" class="form-control" id="inputPrenom" name="prenom" required>
    </div>
    <div class="form-group">
        <label for="inputEmail">E-mail :</label>
        <input type="email" class="form-control" id="inputEmail" name="email" required>
    </div>
    <div class="form-group">
        <label for="inputMessage">Message :</label>
        <textarea class="form-control" id="inputMessage" name="message" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
