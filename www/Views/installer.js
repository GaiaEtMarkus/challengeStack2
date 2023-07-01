const userForm = document.getElementById('siteDataForm');
userForm.addEventListener('submit', handleSubmit);
console.log('ok');

function handleSubmit(event) {
  event.preventDefault();

  console.log('ok');

  const formData = new FormData(userForm);

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
    PASSWORD="${formData.get('password')}"
    PHONE="${formData.get('phone')}"
  `;

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
