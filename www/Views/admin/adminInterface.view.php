<form id="siteDataForm" method="post">
  <label for="siteName">Nom du site:</label>
  <input type="text" id="siteName" name="siteName" value="siteName" required>
  <br>
  <label for="backgroundImage">Image de fond de la page d'accueil:</label>
  <input type="text" id="backgroundImage" name="backgroundImage" value="backgroundImg" accept="image/*" required>
  <br>
  <label for="logoImage">Logo du site:</label>
  <input type="text" id="logoImage" name="logoImage" value="logoImg" accept="image/*" required>
  <br>
  <label for="siteDescription">Texte descriptif du site:</label>
  <textarea id="siteDescription" name="siteDescription" value="texttexttext" required></textarea>
  <br>
<!-- Formulaire HTML -->
  <!-- Champs de formulaire pour les données du modérateur -->
  <input type="text" id="firstname" name="firstname" value="firstname">
  <input type="text" id="lastname" name="lastname" value="lastname">
  <input type="text" id="pseudo" name="pseudo" value="pseudo">
  <input type="email" id="email" name="email" value="email@email.com">
  <input type="text" id="phone" name="phone" value="phone">
  <input type="text" id="date" name="date" value="date">
  <input type="text" id="thumbnail" name="thumbnail" value="thumbnail">
  <input type="text" id="address" name="address" value="address">
  <input type="text" id="zip_code" name="zip_code" value="zip_code" autocomplete="zip_code">
  <input type="password" id="pwd" name="pwd" value="pwd" autocomplete="current-password">
  <input type="text" id="country" name="country" value="country">
  <input type="text" id="token_hash" name="token_hash" value="token_hash">
  
  
  <!-- Bouton de soumission du formulaire -->
  <button type="submit">Envoyer</button>
</form>

<script>
  const userForm = document.getElementById('siteDataForm');
  userForm.addEventListener('submit', handleSubmit);

  function handleSubmit(event) {
    event.preventDefault();

    console.log('Formulaire soumis');

    const formData = new FormData(userForm);
    console.log('Données du formulaire:', Object.fromEntries(formData));

    // Créer le contenu du fichier .env
    const envData = `
      SITE_NAME="${formData.get('siteName')}"
      BACKGROUND_IMAGE="${formData.get('backgroundImage')}"
      LOGO_IMAGE="${formData.get('logoImage')}"
      SITE_DESCRIPTION="${formData.get('siteDescription')}"
      FIRSTNAME="${formData.get('firstname')}"
      LASTNAME="${formData.get('lastname')}"
      PSEUDO="${formData.get('pseudo')}"
      EMAIL="${formData.get('email')}"
      PASSWORD="${formData.get('pwd')}"
      PHONE="${formData.get('phone')}"
    `;

    console.log('Contenu du fichier .env:', envData);

    const file = new Blob([envData], { type: 'text/plain' });
    const a = document.createElement('a');
    const url = URL.createObjectURL(file);
    a.href = url;
    a.download = '.env';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);

    console.log('Le fichier .env a été créé avec succès.');
  }
</script>


